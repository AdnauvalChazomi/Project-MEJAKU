<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Owner;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredOwnerController extends Controller
{
    public function create(): View
    {
        return view('auth.register-owner');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama_restoran' => ['required', 'string', 'max:255'],
            'alamat_restoran' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp ?? null,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);

        Owner::create([
            'user_id' => $user->id,
            'nama_restoran' => $request->nama_restoran,
            'alamat_restoran' => $request->alamat_restoran,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
