<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('owner.dashboard', compact('user'));
    }
}
