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


    public function confirm(Request $request, $id)
    {
        $reservation = Reservation::with(['order.items.menu', 'owner'])->findOrFail($id);
        $user = auth()->user();

        $reservation->update([
            'catatan' => $request->input('catatan')
        ]);

        $reservationFee = 10000;
        $subtotal = 0;
        $tax = 0;
        $diskon = 0;
        $promo = null;
        $itemDetails = [];

        if ($reservation->order) {
            $order = $reservation->order;

            // ✅ Gunakan total_setelah_diskon jika promo_id tidak null
            if ($order->promo_id) {
                $promo = $order->promo; // ambil relasi promo
                $diskon = $order->diskon ?? 0;
                $subtotal = (int) $order->total_setelah_diskon;
            } else {
                $subtotal = (int) $order->total_harga;
            }

            $tax = (int) round($subtotal * 0.1);

            $itemDetails = $order->items->map(function ($item) {
                return [
                    'id' => $item->id ?? uniqid(),
                    'price' => (int) $item->menu->harga,
                    'quantity' => (int) $item->jumlah,
                    'name' => $item->menu->nama_menu ?? 'Item Tanpa Nama',
                ];
            })->toArray();
        }

        // Tambahkan pajak & biaya reservasi
        $itemDetails[] = [
            'id' => 'tax-10',
            'price' => $tax,
            'quantity' => 1,
            'name' => 'Pajak 10%',
        ];

        $itemDetails[] = [
            'id' => 'reservation-fee',
            'price' => $reservationFee,
            'quantity' => 1,
            'name' => 'Biaya Reservasi',
        ];

        // ✅ Jika promo_id sudah ada, tambahkan item diskon
        if ($promo) {
            $itemDetails[] = [
                'id' => 'promo-discount',
                'price' => -1 * $diskon,
                'quantity' => 1,
                'name' => 'Diskon Promo (' . strtoupper($promo->kode) . ')',
            ];
        } elseif ($request->filled('promo_code')) {
            // Jika user memasukkan promo baru
            $promo = \App\Models\Promo::where('kode', $request->promo_code)
                ->where('owner_id', $reservation->owner->id)
                ->where('aktif', true)
                ->whereDate('tanggal_mulai', '<=', now())
                ->whereDate('tanggal_selesai', '>=', now())
                ->first();

            if ($promo) {
                $diskon = $promo->tipe_diskon === 'persentase'
                    ? ($subtotal * ($promo->nilai_diskon / 100))
                    : $promo->nilai_diskon;

                $diskon = min($diskon, $subtotal);

                $reservation->order->update([
                    'promo_id' => $promo->id,
                    'diskon' => $diskon,
                    'total_setelah_diskon' => max(0, $subtotal - $diskon),
                ]);

                $itemDetails[] = [
                    'id' => 'promo-discount',
                    'price' => -1 * $diskon,
                    'quantity' => 1,
                    'name' => 'Diskon Promo (' . strtoupper($promo->kode) . ')',
                ];
            }
        }

        // Hitung total akhir
        $computedTotal = collect($itemDetails)->sum(fn($item) => $item['price'] * $item['quantity']);
        $computedTotal = max(0, $computedTotal);

        $reservation->order->update([
            'total_setelah_diskon' => $computedTotal,
        ]);

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

        return view('user.payment.index', [
            'snapToken' => $snapToken,
            'reservation' => $reservation,
            'total' => $computedTotal,
            'items' => $reservation->order?->items ?? collect(),
            'tax' => $tax,
            'subtotal' => $subtotal,
            'reservationFee' => $reservationFee,
            'promo' => $promo,
            'diskon' => $diskon,
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
