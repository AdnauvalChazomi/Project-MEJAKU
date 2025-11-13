<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $owner = auth()->user()->owner;

        $promos = Promo::where('owner_id', $owner->id)->get();

        // Pisahkan promo aktif dan selesai
        $promosAktif = $promos->filter(function ($promo) {
            $today = now();
            return $promo->aktif &&
                $today->lt(\Carbon\Carbon::parse($promo->tanggal_selesai)) &&
                $promo->digunakan < $promo->batas_penggunaan;
        });

        $promosSelesai = $promos->filter(function ($promo) {
            $today = now();
            return !$promo->aktif ||
                $today->gte(\Carbon\Carbon::parse($promo->tanggal_selesai)) ||
                $promo->digunakan >= $promo->batas_penggunaan;
        });

        return view('owner.promos.index', compact('owner', 'promosAktif', 'promosSelesai'));
    }

    public function create()
    {
        $owner = auth()->user()->owner;
        return view('owner.promos.create', compact('owner'));
    }

    public function store(Request $request)
    {
        $owner = auth()->user()->owner;

        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:promos,kode',
            'nama_promo' => 'required|string|max:100',
            'tipe_diskon' => 'required|in:persentase,nominal',
            'nilai_diskon' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->tipe_diskon === 'persentase' && $value > 100) {
                        $fail('Nilai diskon dalam persen tidak boleh lebih dari 100%.');
                    }
                },
            ],
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'batas_penggunaan' => 'nullable|integer|min:1',
            'aktif' => 'boolean',
        ]);

        $validated['owner_id'] = $owner->id;
        $validated['digunakan'] = 0;
        $validated['aktif'] = $request->boolean('aktif', true);

        Promo::create($validated);

        return redirect()
            ->route('owner.promos.index')
            ->with('success', 'Promo berhasil ditambahkan.');
    }



    public function edit(Promo $promo)
    {
        $owner = auth()->user()->owner;

        if ($promo->owner_id !== $owner->id) {
            abort(403, 'Akses ditolak');
        }

        return view('owner.promos.edit', compact('promo', 'owner'));
    }

    public function update(Request $request, Promo $promo)
    {
        $owner = auth()->user()->owner;

        if ($promo->owner_id !== $owner->id) {
            abort(403, 'Akses ditolak');
        }

        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:promos,kode,' . $promo->id,
            'nama_promo' => 'required|string|max:100',
            'tipe_diskon' => 'required|in:persentase,nominal',
            'nilai_diskon' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->tipe_diskon === 'persentase' && $value > 100) {
                        $fail('Nilai diskon dalam persen tidak boleh lebih dari 100%.');
                    }
                },
            ],
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'batas_penggunaan' => 'nullable|integer|min:1',
            'aktif' => 'boolean',
        ]);

        $promo->update($validated);

        return redirect()
            ->route('owner.promos.index')
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        $owner = auth()->user()->owner;

        if ($promo->owner_id !== $owner->id) {
            abort(403, 'Akses ditolak');
        }

        $promo->delete();

        return redirect()
            ->route('owner.promos.index')
            ->with('success', 'Promo berhasil dihapus.');
    }
}
