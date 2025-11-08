<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        $customerId = auth()->user()->customer->id;

        $reservations = Reservation::with([
            'owner',
            'customer',
            'order.items.menu',
            'meja'
        ])
            ->where('customer_id', $customerId)
            ->latest()
            ->get();

        $riwayat = $reservations->map(function ($reservation) {
            $order = $reservation->order;
            $owner = $reservation->owner;

            $total = $order->total_harga ?? 0;
            $meja = optional($reservation->meja)->nomor ?? 'Belum ada';
            $telepon = $owner->user->no_hp;

            if ($reservation->tanggal_reservasi && $reservation->jam_reservasi) {
                $tanggalWaktu = Carbon::parse(
                    $reservation->tanggal_reservasi . ' ' . $reservation->jam_reservasi
                );
            } else {
                $tanggalWaktu = $reservation->created_at;
            }

            $formattedDate = $tanggalWaktu
                ->locale('id')
                ->translatedFormat('d M Y, H:i');

            return [
                'id' => $reservation->id,
                'tanggal' => $formattedDate,
                'meja' => $meja,
                'telepon' => $telepon,
                'restoran' => $owner->nama_restoran ?? 'Restoran Tidak Diketahui',
                'alamat' => $owner->alamat_restoran ?? '-',
                'jumlah_tamu' => $reservation->jumlah_tamu ?? 0,
                'total' => $total,
                'area' => $reservation->area,
                'status' => $order->status ?? 'reservasi',
                'reservationStatus' => $reservation->status
            ];
        });

        return view('user.history.index', [
            'riwayat' => $riwayat,
        ]);
    }
}
