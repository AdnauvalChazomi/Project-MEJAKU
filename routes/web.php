<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/dashboard-login', function () {
    return view('dashboard-login');
});

Route::post('/logout', function () {
    Auth::logout(); // hapus session user
    return redirect()->route('login'); // arahkan ke route login
})->name('logout');

Route::get('/dashboard-login', function () {
    return view('dashboard-login'); // file resources/views/dashboard-login.blade.php
})->name('dashboard.login');

