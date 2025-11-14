<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Reservation;
use App\Services\MidtransSnapService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $midtransSnapService;

    public function __construct(MidtransSnapService $midtransSnapService)
    {
        $this->midtransSnapService = $midtransSnapService;
    }

    public function show($id)
    {
        $reservation = Reservation::with([
            'owner',
            'customer.user',
            'order.items.menu',
            'meja',
            'order.promo'
        ])->findOrFail($id);

        if ($reservation->customer_id !== auth()->user()->customer->id) {
            abort(403, 'Anda tidak berhak mengakses reservasi ini.');
        }

        $reservationFee = 10000;

        $order = $reservation->order;
        $subtotal = 0;
        $diskon = 0;
        $pajak = 0;
        $total = 0;
        $promoApplied = null;

        if ($order && $order->items->isNotEmpty()) {
            if ($order->promo_id) {
                $subtotal = $order->total_setelah_diskon;
                $diskon = $order->diskon;
                $promoApplied = $order->promo;
            } else {
                $subtotal = $order->total_harga;
            }

            $pajak = round($subtotal * 0.1);
            $total = $subtotal + $pajak + $reservationFee;
        } else {
            $subtotal = 0;
            $pajak = 0;
            $diskon = 0;
            $total = $reservationFee;
        }

        if ($reservation->status === 'paid') {
            Notification::create([
                'notifiable_type' => 'App\Models\Owner',
                'notifiable_id' => $reservation->owner_id,
                'reservation_id' => $reservation->id,
                'title' => 'Pembayaran Diterima',
                'message' => "Pembayaran untuk reservasi #{$reservation->nomor_pesanan} oleh {$reservation->customer->user->name} telah diterima.",
                'type' => 'success',
            ]);
        }

        return view('user.payment.index', compact(
            'reservation',
            'reservationFee',
            'subtotal',
            'diskon',
            'pajak',
            'total',
            'promoApplied'
        ));
    }

    public function cancel($id)
    {
        $reservation = Reservation::with('order')->findOrFail($id);
        $user = auth()->user();

        if (
            !($user->customer && $reservation->customer_id === $user->customer->id) &&
            !($user->owner && $reservation->owner_id === $user->owner->id)
        ) {
            abort(403, 'Anda tidak berhak membatalkan reservasi ini.');
        }

        Notification::create([
            'notifiable_type' => 'App\Models\Owner',
            'notifiable_id' => $reservation->owner_id,
            'reservation_id' => $reservation->id,
            'title' => 'Reservasi Dibatalkan',
            'message' => "Reservasi #{$reservation->nomor_pesanan} oleh {$reservation->customer->user->name} telah dibatalkan.",
            'type' => 'warning',
        ]);

        Notification::create([
            'notifiable_type' => 'App\Models\Customer',
            'notifiable_id' => $reservation->customer_id,
            'reservation_id' => $reservation->id,
            'title' => 'Reservasi Dibatalkan',
            'message' => "Hai {$reservation->customer->user->name}, reservasi Anda (#{$reservation->nomor_pesanan}) telah dibatalkan.",
            'type' => 'warning',
        ]);

        $reservation->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function terapkanPromo(Request $request, $id)
    {
        $request->validate([
            'promo_code' => 'required|string'
        ]);

        $reservation = Reservation::with(['order', 'owner'])->findOrFail($id);
        $order = $reservation->order;

        if (!$order) {
            return response()->json([
                'valid' => false,
                'message' => 'Tidak ada pesanan yang bisa diberi promo.'
            ]);
        }

        $promo = \App\Models\Promo::where('kode', $request->promo_code)
            ->where('owner_id', $reservation->owner->id)
            ->where('aktif', true)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();

        if (!$promo) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode promo tidak ditemukan untuk restoran ini atau sudah tidak berlaku.'
            ]);
        }

        $subtotal = $order->total_harga;
        $diskon = $promo->tipe_diskon === 'persentase'
            ? ($subtotal * ($promo->nilai_diskon / 100))
            : $promo->nilai_diskon;

        $diskon = min($diskon, $subtotal);
        $totalSetelahDiskon = $subtotal - $diskon;

        $order->update([
            'promo_id' => $promo->id,
            'diskon' => $diskon,
            'total_setelah_diskon' => $totalSetelahDiskon,
        ]);

        return response()->json([
            'valid' => true,
            'message' => "Promo berhasil diterapkan!",
            'diskon' => $diskon,
            'total_setelah_diskon' => $totalSetelahDiskon,
        ]);
    }

}
