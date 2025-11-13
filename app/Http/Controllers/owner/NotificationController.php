<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Tampilkan daftar notifikasi untuk owner yang sedang login
     */
    public function index()
    {
        $owner = auth()->user()->owner;

        if (!$owner) {
            abort(403, 'Anda bukan owner.');
        }

        $notifications = Notification::with('reservation')
            ->where('notifiable_id', $owner->id)
            ->where('notifiable_type', 'App\Models\Owner')
            ->orderByDesc('created_at')
            ->get();

        return view('owner.notification', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $owner = auth()->user()->owner;
        if ($notification->notifiable_type !== 'App\Models\Owner' || $notification->notifiable_id !== $owner->id) {
            abort(403, 'Anda tidak berhak mengubah notifikasi ini.');
        }

        $notification->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}
