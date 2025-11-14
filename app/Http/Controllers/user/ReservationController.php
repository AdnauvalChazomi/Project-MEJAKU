<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Notification;
use App\Models\Owner;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function create($id)
    {
        $user = auth()->user();
        $customer = $user->customer;

        $restoran = Owner::with(['menuUnggulan', 'operational'])->findOrFail($id);
        $menus = $restoran->menus()->latest()->take(4)->get();

        return view('user.reservations.create', compact('restoran', 'menus', 'user', 'customer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'tanggal_reservasi' => 'required|date|after_or_equal:today',
            'jam_reservasi' => 'required',
            'jumlah_tamu' => 'required|integer|min:1',
            'area' => 'required|in:Indoor,Outdoor,Semi Outdoor',
        ]);

        $user = auth()->user();
        $customer = $user->customer;

        $allUsed = Meja::where('owner_id', $validated['owner_id'])
            ->where('status', 'digunakan')
            ->count();

        $totalMeja = Meja::where('owner_id', $validated['owner_id'])->count();

        if ($totalMeja > 0 && $allUsed >= $totalMeja) {
            return redirect()->back()->with('error', 'Maaf, semua meja di restoran ini sedang digunakan.')->withInput();
        }

        $validated['customer_id'] = $customer->id;
        $validated['status'] = 'pending';

        $tanggal = now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        $nomorPesanan = "RES-{$tanggal}-{$random}";

        while (Reservation::where('nomor_pesanan', $nomorPesanan)->exists()) {
            $random = strtoupper(Str::random(6));
            $nomorPesanan = "RES-{$tanggal}-{$random}";
        }

        $validated['nomor_pesanan'] = $nomorPesanan;

        $reservation = Reservation::create($validated);

        Notification::create([
            'notifiable_type' => 'App\Models\Owner',
            'notifiable_id' => $validated['owner_id'],
            'reservation_id' => $reservation->id,
            'title' => 'Reservasi Baru',
            'message' => "{$customer->user->name} telah membuat reservasi untuk {$validated['jumlah_tamu']} tamu pada {$validated['tanggal_reservasi']} pukul {$validated['jam_reservasi']}.",
            'type' => 'info',
        ]);

        return redirect()
            ->route('preorder.index', ['reservation' => $reservation->id])
            ->with('success', 'Reservasi berhasil dibuat! Silakan pilih menu Anda.');
    }

    public function review($ownerId)
    {
        $owner = Owner::findOrFail($ownerId);

        $userId = auth()->id();

        $reviews = Review::where('owner_id', $ownerId)
            ->with('user')
            ->orderByRaw("CASE WHEN user_id = ? THEN 0 ELSE 1 END", [$userId])
            ->orderBy('created_at', 'desc')
            ->get();

        $userReview = Review::where('owner_id', $ownerId)
            ->where('user_id', auth()->id())
            ->first();

        return view('user.restoran.review', compact('owner', 'reviews', 'userReview'));
    }

    public function storeReview(Request $request, $ownerId)
    {
        $existing = Review::where('owner_id', $ownerId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->route('restoran.review', $ownerId)
                ->with('error', 'Anda sudah memberikan review untuk restoran ini.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'owner_id' => $ownerId,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()->route('user.restoran.review', $ownerId)
            ->with('success', 'Terima kasih! Review Anda telah disimpan.');
    }

    public function destroyReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);

        if ($review->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus review ini.');
        }

        $ownerId = $review->owner_id;

        $review->delete();

        return redirect()->route('user.restoran.review', $ownerId)
            ->with('success', 'Review berhasil dihapus.');
    }
}

