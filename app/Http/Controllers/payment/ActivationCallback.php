<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;

class ActivationCallback extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        if ($request->transaction_status === 'settlement' || $request->transaction_status === 'capture') {
            $parts = explode('-', $request->order_id);
            $userId = end($parts);

            $owner = Owner::where('user_id', $userId)->first();
            if ($owner) {
                $owner->update(['tier' => 'subs']);
            }

            return response()->json(['message' => 'Owner tier updated successfully']);
        }

        return response()->json(['message' => 'Payment not settled yet']);
    }
}
