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
            return redirect()->route('neopayment.confirm', [
                'id' => $user->owner->id,
                'type' => 'activation',
            ])->with('warning', 'Silakan lakukan pembayaran aktivasi.');
        }

        return view('owner.dashboard', compact('user'));
    }
}
