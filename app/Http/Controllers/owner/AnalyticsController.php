<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $applyFilter = function ($query) use ($filter) {
            if ($filter === 'today') {
                $query->whereDate('tanggal_reservasi', now());
            } elseif ($filter === 'week') {
                $query->whereBetween('tanggal_reservasi', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            } elseif ($filter === 'month') {
                $query->whereMonth('tanggal_reservasi', now()->month)
                    ->whereYear('tanggal_reservasi', now()->year);
            }
        };

        $totalReservasi = Reservation::select(
            DB::raw('DATE(tanggal_reservasi) as tanggal'),
            DB::raw('COUNT(*) as total')
        )
            ->where('status', '!=', 'cancelled')
            ->tap($applyFilter)
            ->groupBy(DB::raw('DATE(tanggal_reservasi)'))
            ->orderBy('tanggal', 'asc')
            ->get();

        $jamSibuk = Reservation::select(
            DB::raw('HOUR(jam_reservasi) as jam'),
            DB::raw('COUNT(*) as total')
        )
            ->where('status', '!=', 'cancelled')
            ->tap($applyFilter)
            ->groupBy('jam')
            ->orderBy('jam')
            ->get();

        $menuFavorit = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('reservations', 'order_items.order_id', '=', 'reservations.id')
            ->select('menus.id', 'menus.nama', DB::raw('SUM(order_items.jumlah) as total_terjual'))
            ->where('reservations.status', '!=', 'cancelled')
            ->groupBy('menus.id', 'menus.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view('owner.analytics.index', [
            'filter' => $filter,

            'reservasi_labels' => $totalReservasi->pluck('tanggal')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M')),
            'reservasi_data' => $totalReservasi->pluck('total'),

            'jam_labels' => $jamSibuk->pluck('jam')->map(fn($j) => sprintf('%02d:00', $j)),
            'jam_data' => $jamSibuk->pluck('total'),

            'menu_labels' => $menuFavorit->pluck('nama'),
            'menu_data' => $menuFavorit->pluck('total_terjual'),
        ]);
    }
}
