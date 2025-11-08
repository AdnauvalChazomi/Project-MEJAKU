<?php

use App\Http\Controllers\owner\MenuController;
use App\Http\Controllers\owner\OrderController;
use App\Http\Controllers\owner\PromoController;
use App\Http\Controllers\owner\ReservationManageController;
use App\Http\Controllers\owner\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\owner\RestoranController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\owner\DashboardController as DashboardOwnerController;
use App\Http\Controllers\user\HistoryController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\PreorderController;
use App\Http\Controllers\user\ReservationController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/search', [DashboardController::class, 'search'])->name('search');

Route::get('/restoran/{id}', [DashboardController::class, 'show'])->name('user.restoran.show');
Route::get('/restoran/{id}/reservasi', [ReservationController::class, 'create'])->name('reservations.create');
Route::prefix('/restoran/{id}/menu')->group(function () {
    Route::get('/', [\App\Http\Controllers\user\MenuController::class, 'index'])->name('user.menu.index');
});

Route::post('/reservations', [ReservationController::class, 'store'])->middleware('auth')->name('user.reservations.store');

Route::get('/preorder/{reservation}', [PreorderController::class, 'index'])->name('preorder');
Route::post('/preorder/{reservation}', [PreorderController::class, 'store'])->name('preorder.store');
Route::get('/preorder/{reservation}/show', [PreorderController::class, 'show'])->name('preorder.show');
Route::post('/preorder/{id}/confirm', [PreorderController::class, 'confirm'])->name('preorder.confirm');
Route::delete('/preorder/{id}/destroy', [PreorderController::class, 'destroy'])->name('preorder.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::patch('/payment/{id}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

Route::prefix('owner/{ownerId}/reservations')->group(function () {
    Route::get('/', [ReservationManageController::class, 'index'])->name('reservations.index');
    Route::get('/data', [ReservationManageController::class, 'getData'])->name('owner.reservations.data');
    Route::post('/', [ReservationManageController::class, 'store'])->name('reservations.store');
    Route::delete('/last', [ReservationManageController::class, 'destroyLast'])->name('reservations.destroyLast');
});

Route::patch('/meja/{meja}/status', [ReservationManageController::class, 'updateStatus'])->name('reservations.updateStatus');

Route::get('/owner/settings/{id}', [SettingController::class, 'index'])
    ->name('setting.index');

Route::get('/history', [HistoryController::class, 'index'])
    ->name('history');

Route::prefix('owner/dashboard/menu')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/{id}/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/delete/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    Route::post('/upload-foto', [MenuController::class, 'uploadFoto'])->name('menu.uploadFoto');
    Route::delete('/foto/{id}', [MenuController::class, 'destroyFoto'])->name('menu.destroyFoto');
});


Route::prefix('owner/dashboard/pesanan')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('pesanan.index');
});

Route::prefix('owner/dashboard/promo')->group(function () {
    Route::get('/', [PromoController::class, 'index'])->name('promo.index');
});

Route::middleware(['auth'])->prefix('owner/restoran')->name('owner.restoran.')->group(function () {
    Route::get('/', [RestoranController::class, 'edit'])->name('edit');
    Route::post('/foto', [RestoranController::class, 'storeFotoMenu'])->name('foto.menu.store');
    Route::delete('/foto/{id}', [RestoranController::class, 'destroyFotoMenu'])->name('foto.menu.destroy');
    Route::post('/restoran/foto', [RestoranController::class, 'storeFotoRestoran'])->name('foto.store');
    Route::delete('/restoran/foto', [RestoranController::class, 'deleteFotoRestoran'])->name('foto.destroy');
    Route::put('/restoran', [RestoranController::class, 'storeRestoran'])->name('store');
    Route::put('/operational', [RestoranController::class, 'storeOperational'])->name('operational.store');
    Route::post('/unggulan', [RestoranController::class, 'storeMenuUnggulan'])->name('unggulan.store');
    Route::delete('/unggulan', [RestoranController::class, 'destroyMenuUnggulan'])->name('unggulan.destroy');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', [DashboardOwnerController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/dashboard/reservasi', [ReservationManageController::class, 'index'])->name('owner.reservations');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');
});

Route::get('/detail', function () {
    return view('user.detail');
})->name('detail');

Route::get('/reservations', function () {
    return view('user.reservations');
})->name('reservations');

Route::get('/select-menu', function () {
    return view('user.select-menu');
})->name('select-menu');

Route::get('/order', function () {
    return view('user.order');
})->name('order');

Route::get('/payment', function () {
    return view('user.payment');
})->name('payment');

Route::get('/payment/qris', function () {
    return view('payments.qris');
})->name('payment.qris');

Route::get('/payment/wallet', function () {
    return view('payments.wallet');
})->name('payment.wallet');

Route::get('/payment/bank', function () {
    return view('payments.bank');
})->name('payment.bank');

Route::get('/status', function () {
    return view('user.status');
})->name('status');


Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');

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
    return view('user.pembayaran');
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

Route::get('/kelola-menu/tambahmenu', function () {
    return view('owner.menu.create');
})->name('kelola-menu.create');

Route::get('/owner/settings', function () {
    return view('owner.settings');
})->name('owner.settings');

Route::get('/owner/promos', function () {
    return view('owner.promos.create');
})->name('promos.create');

Route::get('/owner/profilrestoran', function () {
    return view('owner.profile.profilerestoran');
})->name('profile.profilrestoran');

Route::get('/owner/premium', function () {
    return view('owner.premium.index');
})->name('premium.index');

Route::get('/premium/pembayaran', function () {
    return view('owner.premium.pembayaran');
})->name('premium.pembayaran');

Route::get('owner/metadata', function () {
    return view('auth.owner.owner-metadata');
})->name('owner.owner-metadata');

Route::get('owner/pembayaran', function () {
    return view('auth.owner.detail-pembayaran');
})->name('owner.detail-pembayaran');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/dashboard-owner', function () {
    return view('owner.dashboard');
});

Route::get('/notifikasi', function () {
    return view('owner.notification');
});

Route::get('/pengaturan', function () {
    return view('owner.settings');
});

Route::get('/manajemen-reservasi', function () {
    return view('owner.reservations.index');
});

Route::get('/kelola-menu', function () {
    return view('owner.menu.index');
});

Route::get('/kelola-pesanan', function () {
    return view('owner.orders.index');
});

Route::get('/kelola-promo', function () {
    return view('owner.promos.index');
});

Route::get('/analytic', function () {
    return view('owner.analytics.index');
});

Route::get('/integrasi-pre-order', function () {
    return view('owner.integrasi-pre-order.index');
});

Route::get('/manajemen-acara', function () {
    return view('owner.manajemen-acara.index');
});




Route::post('/logout', function () {
    // Auth::logout(); // hapus session user
    return redirect()->route('login'); // arahkan ke route login
})->name('logout');


require __DIR__ . '/auth.php';
