<?php

namespace App\Http\Controllers;

use App\Models\Operational;
use Illuminate\Http\Request;

class OperationalController extends Controller
{
    public function index()
    {
        $operational = Operational::with('owner')->get();
        return response()->json($operational);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'area' => 'nullable|in:Indoor,Outdoor,Semi Outdoor',
            'jumlah_meja' => 'required|integer|min:0',
            'jumlah_kursi' => 'required|integer|min:0',
            'kategori_layanan' => 'required|string|max:255',
        ]);

        $operational = Operational::create($validated);
        return response()->json([
            'message' => 'Data operasional berhasil ditambahkan',
            'data' => $operational
        ], 201);
    }

    public function show($id)
    {
        $operational = Operational::with('owner')->findOrFail($id);
        return response()->json($operational);
    }

    public function update(Request $request, $id)
    {
        $operational = Operational::findOrFail($id);

        $validated = $request->validate([
            'hari' => 'sometimes|required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka' => 'sometimes|required|date_format:H:i',
            'jam_tutup' => 'sometimes|required|date_format:H:i|after:jam_buka',
            'area' => 'nullable|in:Indoor,Outdoor,Semi Outdoor',
            'jumlah_meja' => 'sometimes|required|integer|min:0',
            'jumlah_kursi' => 'sometimes|required|integer|min:0',
            'kategori_layanan' => 'sometimes|required|string|max:255',
        ]);

        $operational->update($validated);

        return response()->json([
            'message' => 'Data operasional berhasil diperbarui',
            'data' => $operational
        ]);
    }

    public function destroy($id)
    {
        $operational = Operational::findOrFail($id);
        $operational->delete();

        return response()->json(['message' => 'Data operasional berhasil dihapus']);
    }
}
