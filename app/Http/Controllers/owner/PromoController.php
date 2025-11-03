<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class PromoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('owner.promos.index', compact('user'));
    }
}
