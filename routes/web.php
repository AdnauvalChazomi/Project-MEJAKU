<?php

use App\Http\Controllers\owner\AnalyticsController;
use App\Http\Controllers\owner\MenuController;
use App\Http\Controllers\owner\MetadataController;
use App\Http\Controllers\owner\NotificationController;
use App\Http\Controllers\user\NotificationController as UserNotification;
use App\Http\Controllers\owner\OrderController;
use App\Http\Controllers\owner\OrderManageController;
use App\Http\Controllers\owner\PremiumController;
use App\Http\Controllers\owner\PromoController;
use App\Http\Controllers\owner\ReservationManageController;
use App\Http\Controllers\owner\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\owner\RestoranController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\owner\DashboardController as DashboardOwnerController;
use App\Http\Controllers\user\HistoryController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\PaymentController as NeoPaymentController;
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
Route::delete('/preorder/{id}', [PreorderController::class, 'destroy'])->name('preorder.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::patch('/payment/{id}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/neopayment/{id}/confirm', [NeoPaymentController::class, 'confirm'])->name('neopayment.confirm');
});

Route::prefix('owner/{ownerId}/reservations')->group(function () {
    Route::get('/', [ReservationManageController::class, 'index'])->name('reservations.index');
    Route::get('/data', [ReservationManageController::class, 'getData'])->name('owner.reservations.data');
    Route::post('/', [ReservationManageController::class, 'store'])->name('reservations.store');
    Route::delete('/last', [ReservationManageController::class, 'destroyLast'])->name('reservations.destroyLast');
});

Route::patch('/meja/{meja}/status', [ReservationManageController::class, 'updateStatus'])->name('reservations.updateStatus');

Route::get('/owner/orders/{id}', [OrderManageController::class, 'index'])
    ->name('orders.index');

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
    Route::get('/', [PromoController::class, 'index'])->name('owner.promos.index');
    Route::get('/tambah', [PromoController::class, 'create'])->name('owner.promos.create');
        Route::post('/', [PromoController::class, 'store'])->name('owner.promos.store');
    Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('owner.promos.edit');
    Route::put('/{promo}', [PromoController::class, 'update'])->name('owner.promos.update');
    Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('owner.promos.destroy');
});

Route::prefix('owner/metadata')->name('owner.metadata.')->group(function () {
    Route::get('/', [MetadataController::class, 'create'])->name('create');
    Route::post('/', [MetadataController::class, 'store'])->name('store');
    Route::post('/foto', [MetadataController::class, 'storeFoto'])->name('store.foto');
    Route::get('/payment', [MetadataController::class, 'paymentPage'])->name('payment');
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

Route::post('/owner/reservations/{id}/assign-meja', [ReservationManageController::class, 'assignMeja'])
    ->name('owner.reservations.assign-meja');

Route::patch('/owner/reservations/{id}/selesai', [ReservationManageController::class, 'markAsSelesai'])
    ->name('owner.reservations.markAsSelesai');

Route::get('/owner/premium', [PremiumController::class, 'index'])->name('premium');
Route::get('/owner/dashboard/notification', [NotificationController::class, 'index'])->name('owner.notification');
Route::get('/user/notification', [UserNotification::class, 'index'])->name('user.notification');
Route::post('/owner/notification/reminder', [OrderManageController::class, 'sendReminder'])
    ->middleware(['auth'])
    ->name('owner.notification.reminder');
Route::post('/owner/notification/pickup', [OrderManageController::class, 'notifyPickup'])
    ->middleware(['auth'])
    ->name('owner.notification.pickup');

Route::get('/owner/dashboard/analytics', [AnalyticsController::class, 'index'])
    ->name('owner.analytics')
    ->middleware(['auth']);

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

// Route::get('/owner/promos', function () {
//     return view('owner.promos.create');
// })->name('promos.create');

Route::get('/owner/profilrestoran', function () {
    return view('owner.profile.profilerestoran');
})->name('profile.profilrestoran');

Route::get('/premium/pembayaran', function () {
    return view('owner.premium.pembayaran');
})->name('premium.pembayaran');

// Route::get('owner/metadata', function () {
//     return view('auth.owner.metadata');
// })->name('owner.metadata');

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


Route::get('/pengaturan', function () {
    return view('owner.settings');
})->name('pengaturan');

Route::get('/manajemen-reservasi', function () {
    return view('owner.reservations.index');
})->name('reservasi');

Route::get('/kelola-menu', function () {
    return view('owner.menu.index');
})->name('menu');

Route::get('/kelola-pesanan', function () {
    return view('owner.orders.index');
})->name('pesanan');

Route::get('/kelola-promo', function () {
    return view('owner.promos.index');
})->name('promo');

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
