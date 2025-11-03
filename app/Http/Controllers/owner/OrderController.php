<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('owner.orders.index', compact('user'));
    }
}
