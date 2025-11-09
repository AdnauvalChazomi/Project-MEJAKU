<?php

namespace App\Http\Controllers\callback;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Owner;

class ReservationCallback extends Controller
{
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
}
