<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Notification;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationManageController extends Controller
{
    public function index()
    {
        $ownerId = auth()->user()->owner->id;
        $mejas = Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get();

        $penuh = Reservation::with(['customer.user', 'order.items.menu', 'meja'])
            ->where('owner_id', $ownerId)
            ->whereNotNull('meja_id')
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->get();

        $direservasi = Reservation::with(['customer.user', 'order.items.menu'])
            ->where('owner_id', $ownerId)
            ->whereNull('meja_id')
            ->latest()
            ->get();

        $completed = Reservation::where('status', 'completed')->where('owner_id', $ownerId)->get();
        $cancelled = Reservation::where('status', 'cancelled')->where('owner_id', $ownerId)->get();

        return view('owner.reservations.index', compact('mejas', 'ownerId', 'penuh', 'direservasi', 'completed', 'cancelled'));
    }


    public function getData()
    {
        $ownerId = auth()->user()->owner->id;
        return Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get(['id', 'nomor', 'status']);
    }

    public function assignMeja(Request $request, $id)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
        ]);

        $reservation = Reservation::findOrFail($id);

        $reservation->meja_id = $request->meja_id;
        $reservation->save();

        $meja = Meja::findOrFail($request->meja_id);
        $meja->update(['status' => 'digunakan']);

        // Notifikasi untuk owner
        Notification::create([
            'notifiable_type' => 'App\Models\Owner',
            'notifiable_id' => $reservation->owner_id,
            'reservation_id' => $reservation->id,
            'title' => 'Meja Ditambahkan ke Reservasi',
            'message' => "Reservasi #{$reservation->nomor_pesanan} telah diberi meja nomor {$meja->nomor}.",
            'type' => 'success',
        ]);

        // Notifikasi untuk customer
        Notification::create([
            'notifiable_type' => 'App\Models\Customer',
            'notifiable_id' => $reservation->customer_id,
            'reservation_id' => $reservation->id,
            'title' => 'Meja Telah Ditentukan',
            'message' => "Reservasi Anda (#{$reservation->nomor_pesanan}) telah diberikan meja nomor {$meja->nomor}.",
            'type' => 'info',
        ]);

        return back()->with('success', 'Meja berhasil ditambahkan ke reservasi!');
    }

    public function markAsSelesai($id)
    {
        $reservation = Reservation::with('meja')->findOrFail($id);

        if (!$reservation->meja) {
            return redirect()->back()->with('error', 'Reservasi ini belum memiliki meja.');
        }

        $reservation->update(['status' => 'completed']);

        $reservation->meja->update(['status' => 'tersedia']);

        Notification::create([
            'notifiable_type' => 'App\Models\Owner',
            'notifiable_id' => $reservation->owner_id,
            'reservation_id' => $reservation->id,
            'title' => 'Reservasi Selesai',
            'message' => "Reservasi #{$reservation->nomor_pesanan} telah selesai. Meja nomor {$reservation->meja->nomor} kini tersedia kembali.",
            'type' => 'info',
        ]);

        Notification::create([
            'notifiable_type' => 'App\Models\Customer',
            'notifiable_id' => $reservation->customer_id,
            'reservation_id' => $reservation->id,
            'title' => 'Reservasi Selesai',
            'message' => "Reservasi Anda (#{$reservation->nomor_pesanan}) telah selesai. Terima kasih telah menggunakan layanan kami!",
            'type' => 'success',
        ]);

        return redirect()->back()->with('success', 'Reservasi ditandai selesai dan meja kini tersedia kembali.');
    }

    public function store(Request $request)
    {
        $ownerId = auth()->user()->owner->id;
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $lastNumber = Meja::where('owner_id', $ownerId)->max('nomor') ?? 0;

        for ($i = 1; $i <= $validated['jumlah']; $i++) {
            Meja::create([
                'owner_id' => $ownerId,
                'nomor' => $lastNumber + $i,
                'status' => 'tersedia',
            ]);
        }

        return redirect()->back()->with('success', "{$validated['jumlah']} meja berhasil ditambahkan.");
    }

    public function destroyLast()
    {
        $ownerId = auth()->user()->owner->id;
        $lastMeja = Meja::where('owner_id', $ownerId)
            ->orderByDesc('nomor')
            ->first();

        if (!$lastMeja) {
            return redirect()->back()->with('error', 'Tidak ada meja yang bisa dihapus.');
        }

        $lastMeja->delete();

        return redirect()->back()->with('success', "Meja nomor {$lastMeja->nomor} berhasil dihapus.");
    }
}
