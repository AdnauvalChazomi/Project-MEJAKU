<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\PricingPlans;
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

    public function confirm(Request $request, $id)
    {
        $user = auth()->user();
        $type = $request->input('type', 'reservation');
        $owner = Owner::where('user_id', $user->id)->first();

        if ($owner && $owner->tier !== null && $type === 'activation') {
            return redirect()->route('owner.dashboard')
                ->with('info', 'Kamu sudah aktif. Tidak perlu melakukan aktivasi lagi.');
        }

        $reservationFee = 10000;
        $subtotal = 0;
        $tax = 0;
        $itemDetails = [];
        $items = collect();
        $total = 0;

        switch ($type) {
            case 'reservation':
                $reservation = Reservation::with('order.items.menu', 'order.promo')->findOrFail($id);
                $reservation->update(['catatan' => $request->input('catatan')]);

                $total = $this->prepareReservationItems($reservation, $request, $subtotal, $tax, $items, $itemDetails, $promo);
                $promo = $reservation->order->promo ?? null;
                $orderId = $reservation->nomor_pesanan ?? 'RES-' . $reservation->id;
                break;

            case 'monthly':
                $plan = PricingPlans::getByType('monthly');
                if (!$plan) {
                    abort(404, 'Paket bulanan tidak ditemukan.');
                }

                $itemDetails[] = [
                    'id' => 'monthly-' . $plan->id,
                    'price' => (int) $plan->harga,
                    'quantity' => 1,
                    'name' => $plan->nama_paket,
                ];

                $orderId = 'MNS-' . date('Ymd') . '-' . random_int(100000, 999999) . '-' . $user->id;
                break;

            case 'yearly':
                $plan = PricingPlans::getByType('yearly');
                if (!$plan) {
                    abort(404, 'Paket tahunan tidak ditemukan.');
                }

                $itemDetails[] = [
                    'id' => 'yearly-' . $plan->id,
                    'price' => (int) $plan->harga,
                    'quantity' => 1,
                    'name' => $plan->nama_paket,
                ];

                $orderId = 'YRS-' . date('Ymd') . '-' . random_int(100000, 999999) . '-' . $user->id;
                break;

            case 'activation':
                $plan = PricingPlans::getByType('activation');
                if (!$plan) {
                    abort(404, 'Paket aktivasi tidak ditemukan.');
                }

                $itemDetails[] = [
                    'id' => 'activation-' . $plan->id,
                    'price' => (int) $plan->harga,
                    'quantity' => 1,
                    'name' => $plan->nama_paket,
                ];

                $orderId = 'ACT-' . date('Ymd') . '-' . random_int(100000, 999999) . '-' . $user->id;
                break;

            default:
                abort(400, 'Jenis pembayaran tidak dikenali.');
        }

        $total = collect($itemDetails)->sum(fn($item) => $item['price'] * $item['quantity']);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
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
            'type' => $type,
            'items' => $items,
            'total' => $total,
            'tax' => $tax,
            'subtotal' => $subtotal,
            'promo' => $promo,
            'reservationFee' => $reservationFee,
            'reservation' => $type === 'reservation' ? $reservation : null,
            'plan' => in_array($type, ['monthly', 'yearly', 'activation']) ? $plan : null,
            'activationPlan' => $type === 'activation' ? $plan : null,
        ]);
    }

    private function prepareReservationItems(Reservation $reservation, Request $request, &$subtotal, &$tax, &$items, &$itemDetails, &$promo)
    {
        $reservationFee = 10000;

        if (!$reservation->order) {
            $subtotal = 0;
            $tax = 0;
            $items = collect();
            $itemDetails = [
                [
                    'id' => 'reservation-fee',
                    'price' => $reservationFee,
                    'quantity' => 1,
                    'name' => 'Biaya Reservasi',
                ]
            ];
            return $reservationFee;
        }

        $order = $reservation->order;
        $promo = null;
        $diskon = 0;

        if ($order->promo_id) {
            $promo = $order->promo;
            $diskon = $order->diskon ?? 0;
            $subtotal = (int) $order->total_setelah_diskon;
        } else {
            $subtotal = (int) $order->total_harga;
        }

        $tax = (int) round($subtotal * 0.1);
        $items = $order->items;

        $itemDetails = $items->map(function ($item) {
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

        if ($promo) {
            $itemDetails[] = [
                'id' => 'promo-discount',
                'price' => -1 * $diskon,
                'quantity' => 1,
                'name' => 'Diskon Promo (' . strtoupper($promo->kode) . ')',
            ];
        }

        $itemDetails[] = [
            'id' => 'reservation-fee',
            'price' => $reservationFee,
            'quantity' => 1,
            'name' => 'Biaya Reservasi',
        ];

        return $subtotal + $tax + $reservationFee - $diskon;
    }

}
