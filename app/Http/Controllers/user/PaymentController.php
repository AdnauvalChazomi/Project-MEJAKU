<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

        return view('user.payment.snap', [
            'snapToken' => $snapToken,
            'reservation' => $reservation,
            'total' => $computedTotal,
            'items' => $reservation->order?->items ?? collect(),
            'tax' => $tax,
            'subtotal' => $subtotal,
            'reservationFee' => $reservationFee,
        ]);
    }



    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $signatureKey = $request->signature_key;
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $transactionStatus = $request->transaction_status;

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $reservation = Reservation::where('nomor_pesanan', $orderId)->first();

        if (!$reservation) {
            return response()->json(['message' => 'reservation not found'], 404);
        }

        match ($transactionStatus) {
            'capture', 'settlement' => $reservation->update(['status' => 'paid']),
            'pending' => $reservation->update(['status' => 'pending']),
            'cancel', 'expire', 'deny' => $reservation->update(['status' => 'pending']),
            default => null,
        };

        return response()->json(['message' => 'Callback handled'], 200);
    }

    public function cancel($id)
    {
        $reservation = Reservation::with('order')->findOrFail($id);

        if ($reservation->customer_id !== auth()->user()->customer->id) {
            abort(403, 'Anda tidak berhak membatalkan reservasi ini.');
        }

        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('payment.show', ['id' => $reservation->id])->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
