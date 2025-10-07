<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

Route::get('/jelajahi', function () {
    return view('user.jelajahi');
});

Route::get('/reservasi', function () {
    return view('user.reservasi');
});

Route::get('/dashboard-login', function () {
    return view('dashboard-login');
})->name('dashboard-login');

Route::post('/logout', function () {
    // Auth::logout(); // hapus session user
    return redirect()->route('login'); // arahkan ke route login
})->name('logout');

Route::get('/jam-reservasi', function () {
    return view('user.jam-reservasi'); // file resources/views/dashboard-login.blade.php
})->name('dashboard.login');

Route::get('/waktu-reservasi', function () {
    return view('waktu-reservasi');
})->name('waktu-reservasi');

Route::get('/preorder-1', function () {
    return view('preorder-1');
})->name('preorder-1');

Route::get('/preorder-2', function () {
    return view('preorder-2');
})->name('preorder-2');

Route::get('/pilih-menu', function () {
    return view('pilih-menu');
})->name('pilih-menu');

Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

Route::get('/pembayaran-berhasil', function () {
    return view('pembayaran-berhasil');
})->name('pembayaran-berhasil');

Route::get('/struk', function () {
    return view('struk');
})->name('struk');

Route::get('/smart-queue', function () {
    return view('smart-queue');
})->name('smart-queue');

Route::get('/metode-pembayaran', function () {
    return view('metode-pembayaran');
})->name('metode-pembayaran');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    // Auth::logout(); // hapus session user
    return redirect()->route('login'); // arahkan ke route login
})->name('logout');


require __DIR__ . '/auth.php';
