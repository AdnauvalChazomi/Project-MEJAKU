<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class PremiumController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('owner.premium.index', compact('user'));
    }
}
