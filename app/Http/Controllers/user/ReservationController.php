<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Owner;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function create($id)
    {
        $user = auth()->user();
        $customer = $user->customer;

        $restoran = Owner::with(['menuUnggulan', 'operational'])->findOrFail($id);
        $menus = $restoran->menus()->latest()->take(4)->get();

        return view('user.reservations.create', compact('restoran', 'menus', 'user', 'customer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'tanggal_reservasi' => 'required|date|after_or_equal:today',
            'jam_reservasi' => 'required',
            'jumlah_tamu' => 'required|integer|min:1',
            'area' => 'required|in:Indoor,Outdoor,Semi Outdoor',
        ]);

        $user = auth()->user();
        $customer = $user->customer;

        $allUsed = Meja::where('owner_id', $validated['owner_id'])
            ->where('status', 'digunakan')
            ->count();

        $totalMeja = Meja::where('owner_id', $validated['owner_id'])->count();

        if ($totalMeja > 0 && $allUsed >= $totalMeja) {
            return redirect()->back()->with('error', 'Maaf, semua meja di restoran ini sedang digunakan.')->withInput();
        }

        $validated['customer_id'] = $customer->id;
        $validated['status'] = 'pending';

        $tanggal = now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        $nomorPesanan = "RES-{$tanggal}-{$random}";

        while (Reservation::where('nomor_pesanan', $nomorPesanan)->exists()) {
            $random = strtoupper(Str::random(6));
            $nomorPesanan = "RES-{$tanggal}-{$random}";
        }

        $validated['nomor_pesanan'] = $nomorPesanan;

        $reservation = Reservation::create($validated);

        return redirect()
            ->route('preorder', ['reservation' => $reservation->id])
            ->with('success', 'Reservasi berhasil dibuat! Silakan pilih menu Anda.');
    }


}

