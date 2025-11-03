<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;

class ReservationManageController extends Controller
{
    public function index($ownerId)
    {
        $mejas = Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get();

        return view('owner.reservations.index', compact('mejas', 'ownerId'));
    }

    public function getData($ownerId)
    {
        return Meja::where('owner_id', $ownerId)
            ->orderBy('nomor')
            ->get(['id', 'nomor', 'status']);
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
