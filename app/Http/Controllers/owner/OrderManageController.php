<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Notification;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    public function index($ownerId)
    {
        $mejas = Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get();

        $penuh = Reservation::with(['customer.user', 'order.items.menu', 'meja'])
            ->where('owner_id', $ownerId)
            ->where('status', '!=', 'cancelled')
            ->whereHas('order')
            ->get()
            ->sortBy(function ($item) {
                return [
                    $item->status === 'completed' ? 1 : 0,
                    -$item->created_at->timestamp
                ];
            })
            ->values();

        $direservasi = Reservation::with(['customer.user', 'order.items.menu'])
            ->where('owner_id', $ownerId)
            ->where('status', '!=', 'cancelled')
            ->whereHas('order')
            ->latest()
            ->get();

        return view('owner.orders.index', compact('mejas', 'ownerId', 'penuh', 'direservasi'));
    }

    public function sendReminder(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $reservation = Reservation::with('customer.user')->findOrFail($request->reservation_id);

        if ($reservation->owner_id !== auth()->user()->owner->id) {
            return redirect()->back()->with('error', 'Tidak berhak mengirim reminder.');
        }

        Notification::create([
            'notifiable_type' => 'App\Models\Customer',
            'notifiable_id' => $reservation->customer_id,
            'reservation_id' => $reservation->id,
            'title' => 'Pengingat Reservasi',
            'message' => "Hai {$reservation->customer->user->name}, reservasi Anda (#{$reservation->nomor_pesanan}) akan berlangsung pada pukul {$reservation->jam_reservasi}. Jangan lupa hadir ya!",
            'type' => 'info',
        ]);

        return redirect()->back()->with('success', 'Reminder berhasil dikirim!');
    }

    public function notifyPickup(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $reservation = Reservation::with('customer.user')->findOrFail($request->reservation_id);

        if ($reservation->owner_id !== auth()->user()->owner->id) {
            return redirect()->back()->with('error', 'Tidak berhak mengirim notifikasi.');
        }

        Notification::create([
            'notifiable_type' => 'App\Models\Customer',
            'notifiable_id' => $reservation->customer_id,
            'reservation_id' => $reservation->id,
            'title' => 'Pesanan Siap Diambil',
            'message' => "Hai {$reservation->customer->user->name}, pesanan Anda (#{$reservation->nomor_pesanan}) sudah siap untuk diambil!",
            'type' => 'info',
        ]);

        return redirect()->back()->with('success', 'Notifikasi ambil pesanan berhasil dikirim!');
    }
}
