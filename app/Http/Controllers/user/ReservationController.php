<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Reservation;
use Illuminate\Http\Request;

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

        $validated['customer_id'] = $customer->id;
        $validated['status'] = 'pending';

        $reservation = Reservation::create($validated);

        return redirect()
            ->route('preorder', ['reservation' => $reservation->id])
            ->with('success', 'Reservasi berhasil dibuat! Silakan pilih menu Anda.');
    }
}

