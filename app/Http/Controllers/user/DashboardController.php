<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        $rekomendasi = Owner::select('id', 'nama_restoran', 'alamat_restoran', 'foto_restoran', 'summary')
            ->whereIn('tier', ['month', 'year'])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(4)
            ->get();

        return view('user.dashboard', compact('rekomendasi'));
    }

    public function show($id)
    {
        $restoran = Owner::with([
            'reviews' => function ($query) {
                $query->latest()->take(3)->with('user');
            },
            'fotoMenus'
        ])->findOrFail($id);

        return view('user.restoran.show', compact('restoran'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $lokasi = $request->input('lokasi');

        $restoran = Owner::with('reviews')
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_restoran', 'like', "%{$keyword}%")
                        ->orWhere('alamat_restoran', 'like', "%{$keyword}%");
                });
            })
            ->when($lokasi, function ($query, $lokasi) {
                $query->where('alamat_restoran', 'like', "%{$lokasi}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8)
            ->appends([
                'q' => $keyword,
                'lokasi' => $lokasi,
            ]);

        $wilayah = Owner::select('alamat_restoran')
            ->distinct()
            ->orderBy('alamat_restoran')
            ->pluck('alamat_restoran');

        $restoran = Owner::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_restoran', 'like', "%{$keyword}%")
                        ->orWhere('alamat_restoran', 'like', "%{$keyword}%");
                });
            })
            ->when($lokasi, function ($query, $lokasi) {
                $query->where('alamat_restoran', 'like', "%{$lokasi}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8)
            ->appends([
                'q' => $keyword,
                'lokasi' => $lokasi,
            ]);

        return view('user.search', compact('restoran', 'keyword', 'lokasi', 'wilayah'));
    }
}
