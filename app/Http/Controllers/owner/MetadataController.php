<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Owner;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\MidtransSnapService; // pastikan kamu sudah punya service ini

class MetadataController extends Controller
{
    protected $midtransSnapService;

    public function __construct(MidtransSnapService $midtransSnapService)
    {
        $this->midtransSnapService = $midtransSnapService;
    }

    public function create(): View
    {
        $user = auth()->user();
        return view('auth.owner.metadata', ['user' => $user]);
    }

    public function storeFoto(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        $request->validate([
            'foto_restoran' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $path = $request->file('foto_restoran')->store('foto_restoran', 'public');
        $owner->update(['foto_restoran' => $path]);

        return back()->with('success', 'Foto restoran berhasil diperbarui!');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_restoran' => ['required', 'string', 'max:255'],
            'alamat_restoran' => ['required', 'string'],
            'summary' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'nama_restoran' => $request->nama_restoran,
            'alamat_restoran' => $request->alamat_restoran,
            'summary' => $request->summary,
        ];

        if ($request->hasFile('foto_restoran')) {
            $data['foto_restoran'] = $request->file('foto_restoran')->store('foto_restoran', 'public');
        }

        $owner = Owner::create($data);

        return redirect()->route('neopayment.confirm', [
            'id' => $owner->id,
            'type' => 'activation'
        ]);
    }


    public function paymentPage(): View|RedirectResponse
    {
        $user = auth()->user();

        $snapToken = session('snap_token');
        $activationFee = session('activation_fee');

        if (!$user->owner) {
            return redirect()->route('owner.metadata.create')
                ->with('warning', 'Lengkapi data restoran terlebih dahulu.');
        }

        if (is_null($user->owner->tier)) {
            return view('auth.owner.payment', compact('snapToken', 'activationFee'));
        }

        return redirect()->route('owner.dashboard')
            ->with('info', 'Akun Anda sudah aktif.');
    }


    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        if ($request->transaction_status === 'settlement' || $request->transaction_status === 'capture') {
            $parts = explode('-', $request->order_id);
            $userId = end($parts);

            $owner = Owner::where('user_id', $userId)->first();
            if ($owner) {
                $owner->update(['tier' => 'subs']);
            }

            return response()->json(['message' => 'Owner tier updated successfully']);
        }

        return response()->json(['message' => 'Payment not settled yet']);
    }
}
