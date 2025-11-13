<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Tampilkan daftar notifikasi untuk customer yang sedang login
     */
    public function index()
    {
        $customer = auth()->user()->customer;

        if (!$customer) {
            abort(403, 'Anda bukan customer.');
        }

        $notifications = Notification::with('reservation')
            ->where('notifiable_id', $customer->id)
            ->where('notifiable_type', 'App\Models\customer')
            ->orderByDesc('created_at')
            ->get();

        return view('user.notification', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $customer = auth()->user()->customer;
        if ($notification->notifiable_type !== 'App\Models\Customer' || $notification->notifiable_id !== $customer->id) {
            abort(403, 'Anda tidak berhak mengubah notifikasi ini.');
        }

        $notification->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}
