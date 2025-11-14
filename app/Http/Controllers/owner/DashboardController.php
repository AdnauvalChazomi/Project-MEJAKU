<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        if ($user->role === 'owner' && !$owner) {
            return redirect('/owner/metadata')
                ->with('warning', 'Silakan lengkapi data toko Anda terlebih dahulu.');
        }

        if ($owner->tier === null) {
            return redirect()->route('neopayment.confirm', [
                'id' => $owner->id,
                'type' => 'activation',
            ])->with('warning', 'Silakan lakukan pembayaran aktivasi.');
        }

        $filter = $request->query('filter', 'all');
        // default: "all"

        $query = Reservation::where('owner_id', $owner->id);

        if ($filter === 'month') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }

        if ($filter === 'week') {
            $query->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        }

        // Exec query
        $reservations = $query->get();

        $totalReservasi = $reservations->count();
        $totalTamu = $reservations->sum('jumlah_tamu');
        $totalPesanan = Order::whereIn('reservation_id', $reservations->pluck('id'))->count();

        return view('owner.dashboard', compact(
            'user',
            'filter',
            'totalReservasi',
            'totalTamu',
            'totalPesanan'
        ));
    }

}
