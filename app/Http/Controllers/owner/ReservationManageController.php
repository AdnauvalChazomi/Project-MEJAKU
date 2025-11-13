<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationManageController extends Controller
{
    public function index($ownerId)
    {
        $mejas = Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get();

        $penuh = Reservation::with(['customer.user', 'order.items.menu', 'meja'])
            ->where('owner_id', $ownerId)
            ->whereNotNull('meja_id')
            ->get()
            ->sortBy(function ($item) {
                // completed di bawah, sisanya di atas — tapi tetap urut terbaru di dalam kelompok
                return [
                    $item->status === 'completed' ? 1 : 0, // 1 = bawah, 0 = atas
                    -$item->created_at->timestamp // urut terbaru di atas
                ];
            })
            ->values();

        $direservasi = Reservation::with(['customer.user', 'order.items.menu'])
            ->where('owner_id', $ownerId)
            ->whereNull('meja_id')
            ->latest()
            ->get();

        return view('owner.reservations.index', compact('mejas', 'ownerId', 'penuh', 'direservasi'));
    }


    public function getData($ownerId)
    {
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

        return redirect()->back()->with('success', 'Reservasi ditandai selesai dan meja kini tersedia kembali.');
    }

    public function store(Request $request, $ownerId)
    {
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

    public function destroyLast($ownerId)
    {
        $lastMeja = Meja::where('owner_id', $ownerId)
            ->orderByDesc('nomor')
            ->first();

        if (!$lastMeja) {
            return redirect()->back()->with('error', 'Tidak ada meja yang bisa dihapus.');
        }

        $lastMeja->delete();

        return redirect()->back()->with('success', "Meja nomor {$lastMeja->nomor} berhasil dihapus.");
    }

    public function updateStatus(Request $request, Meja $meja)
    {
        $validated = $request->validate([
            'status' => 'required|in:tersedia,digunakan',
        ]);

        $meja->update($validated);

        return redirect()->back()->with('success', "Status meja {$meja->nomor} diperbarui menjadi {$validated['status']}.");
    }
}
