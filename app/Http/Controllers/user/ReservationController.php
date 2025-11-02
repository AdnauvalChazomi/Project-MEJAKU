<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create($id)
    {
        $restoran = Owner::findOrFail($id);
        $menus = $restoran->menus()->latest()->take(4)->get();

        return view('user.reservations.create', compact('restoran', 'menus'));
    }
}

