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
            'meja'
        ])->findOrFail($id);

        if ($reservation->customer_id !== auth()->user()->customer->id) {
            abort(403, 'Anda tidak berhak mengakses reservasi ini.');
        }

        $reservationFee = 10000;

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

        return view('user.payment.index', compact('reservation', 'reservationFee'));
    }

    public function confirm(Request $request, $id)
    {
        $reservation = Reservation::with('order.items.menu')->findOrFail($id);
        $user = auth()->user();

        $reservation->update([
            'catatan' => $request->input('catatan')
        ]);

        $reservationFee = 10000;
        $subtotal = 0;
        $tax = 0;
        $itemDetails = [];

        if ($reservation->order) {
            $order = $reservation->order;
            $subtotal = (int) $order->total_harga;
            $tax = (int) round($subtotal * 0.1);

            $itemDetails = $order->items->map(function ($item) {
                return [
                    'id' => $item->id ?? uniqid(),
                    'price' => (int) $item->menu->harga,
                    'quantity' => (int) $item->jumlah,
                    'name' => $item->menu->nama_menu ?? 'Item Tanpa Nama',
                ];
            })->toArray();

            $itemDetails[] = [
                'id' => 'tax-10',
                'price' => $tax,
                'quantity' => 1,
                'name' => 'Pajak 10%',
            ];
        }

        $itemDetails[] = [
            'id' => 'reservation-fee',
            'price' => $reservationFee,
            'quantity' => 1,
            'name' => 'Biaya Reservasi',
        ];

        $computedTotal = collect($itemDetails)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $params = [
            'transaction_details' => [
                'order_id' => $reservation->nomor_pesanan ?? 'RES-' . $reservation->id,
                'gross_amount' => $computedTotal,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = $this->midtransSnapService->createSnapToken($params);

        return view('payments.index', [
            'snapToken' => $snapToken,
            'reservation' => $reservation,
            'total' => $computedTotal,
            'items' => $reservation->order?->items ?? collect(),
            'tax' => $tax,
            'subtotal' => $subtotal,
            'reservationFee' => $reservationFee,
        ]);
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
}
