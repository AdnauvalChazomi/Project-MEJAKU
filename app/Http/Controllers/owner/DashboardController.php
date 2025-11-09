<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'owner' && !$user->owner) {
            return redirect('/owner/metadata')
                ->with('warning', 'Silakan lengkapi data toko Anda terlebih dahulu.');
        }

        if ($user->owner->tier === null) {
            return redirect('/owner/metadata/payment')
                ->with('warning', 'Silakan Lakukan pembayaran');
        }

        return view('owner.dashboard', compact('user'));
    }
}
