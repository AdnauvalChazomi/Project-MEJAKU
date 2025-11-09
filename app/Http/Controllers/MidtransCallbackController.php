<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Http\Controllers\payment\ReservationCallback;
use App\Http\Controllers\payment\ActivationCallback;
use App\Http\Controllers\payment\MonthlyCallback;
use App\Http\Controllers\payment\YearlyCallback;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notif = new Notification();

        $orderId = $notif->order_id ?? '';
        $transactionStatus = $notif->transaction_status ?? 'unknown';

        if (empty($orderId)) {
            return response()->json(['message' => 'Invalid callback data'], 400);
        }

        $request->merge([
            'order_id' => $orderId,
            'status_code' => $notif->status_code ?? null,
            'gross_amount' => $notif->gross_amount ?? null,
            'signature_key' => $notif->signature_key ?? null,
            'transaction_status' => $transactionStatus,
        ]);

        $prefix = strtoupper(substr($orderId, 0, 4));

        return match ($prefix) {
            'RES-' => app(ReservationCallback::class)->callback($request),
            'ACT-' => app(ActivationCallback::class)->callback($request),
            'MNS-' => app(MonthlyCallback::class)->callback($request),
            'YRS-' => app(YearlyCallback::class)->callback($request),
            default => response()->json(['message' => 'Unknown order type'], 400),
        };
    }
}
