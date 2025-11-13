<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Reservation;

class OrderManageController extends Controller
{
    public function index($ownerId)
    {
        $mejas = Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get();

        $penuh = Reservation::with(['customer.user', 'order.items.menu', 'meja'])
            ->where('owner_id', $ownerId)
            ->whereNotNull('meja_id')
            ->where('status', '!=', 'cancelled')
            ->whereHas('order')
            ->get()
            ->sortBy(function ($item) {
                return [
                    $item->status === 'completed' ? 1 : 0,
                    -$item->created_at->timestamp
                ];
            })
            ->values();

        $direservasi = Reservation::with(['customer.user', 'order.items.menu'])
            ->where('owner_id', $ownerId)
            ->whereNull('meja_id')
            ->where('status', '!=', 'cancelled')
            ->whereHas('order')
            ->latest()
            ->get();

        return view('owner.orders.index', compact('mejas', 'ownerId', 'penuh', 'direservasi'));
    }
}
