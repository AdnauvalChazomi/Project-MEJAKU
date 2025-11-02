<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class ReservationManageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('owner.reservations.index', compact('user'));
    }
}
