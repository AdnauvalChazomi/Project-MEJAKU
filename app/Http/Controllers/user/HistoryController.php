<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;

class HistoryController extends Controller
{
    public function index()
    {
        $customerId = auth()->user()->customer->id;

        $reservations = Reservation::with([
            'owner',
            'customer',
            'order.items.menu'
        ])->where('customer_id', $customerId)->latest()->get();

        $orders = Order::with(['items.menu', 'reservation.owner'])
            ->whereHas('reservation', function ($q) use ($customerId) {
                $q->where('customer_id', $customerId);
            })->latest()->get();

        return view('user.history.index', [
            'reservations' => $reservations,
            'orders' => $orders,
        ]);
    }
}
