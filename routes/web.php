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
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard-login', function () {
    return view('dashboard-login');
})->name('dashboard-login');

Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

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

Route::get('/pembayaran1', function () {
    return view('pembayaran1');
})->name('pembayaran1');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    // Auth::logout(); // hapus session user
    return redirect()->route('login'); // arahkan ke route login
})->name('logout');

require __DIR__.'/auth.php';