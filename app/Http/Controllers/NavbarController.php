<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class NavbarController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ownerId = $user->owner_id ?? null;
        $customerId = $user->customer_id ?? null;

        return view('components.navbar', compact('user', 'ownerId', 'customerId'));
    }
}
