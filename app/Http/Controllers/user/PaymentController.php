<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

    /**
     * Halaman detail pembayaran
     */
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

        return view('user.payment.index', compact('reservation'));
    }

    /**
     * Proses checkout ke Midtrans (dari tombol “Bayar”)
     */
    public function confirm(Request $request, $id)
    {
        $reservation = Reservation::with('order')->findOrFail($id);
        $order = $reservation->order;
        $user = auth()->user();

        $reservation->update([
            'catatan' => $request->input('catatan')
        ]);

        $total = (int) round($order->total_harga * 1.1);

        $params = [
            'transaction_details' => [
                'order_id' => $order->nomor_pesanan,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        // Generate Snap token
        $snapToken = $this->midtransSnapService->createSnapToken($params);

        // Kirim token ke Blade agar popup Snap bisa tampil
        return view('user.payment.snap', [
            'snapToken' => $snapToken,
            'reservation' => $reservation,
        ]);
    }

    /**
     * Callback Midtrans untuk update status order
     */
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

        $order = Order::where('nomor_pesanan', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        match ($transactionStatus) {
            'capture', 'settlement' => $order->update(['status' => 'paid']),
            'pending' => $order->update(['status' => 'pending']),
            'cancel', 'expire', 'deny' => $order->update(['status' => 'unpaid']),
            default => null,
        };

        return response()->json(['message' => 'Callback handled'], 200);
    }
}
