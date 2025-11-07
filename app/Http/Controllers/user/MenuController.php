<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index($id)
    {
        $ownerId = $id;

        $menus = Menu::where('owner_id', $ownerId)->get();

        return view('user.menu.index', compact('menus', 'ownerId'));
    }
}
