<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('owner.settings', compact('user'));
    }
}
