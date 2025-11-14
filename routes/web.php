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

//=====Route Customer======

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('restoran/{id}')->name('user.restoran.')->group(function () {
    Route::get('/', [DashboardController::class, 'show'])->name('show');
    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');
    Route::get('/review', [ReservationController::class, 'review'])->name('review');
    Route::post('/review', [ReservationController::class, 'storeReview'])->middleware('auth')->name('review.store');
    Route::delete('/review', [ReservationController::class, 'destroyReview'])->middleware('auth')->name('review.destroy');
    Route::get('/menu', [\App\Http\Controllers\user\MenuController::class, 'index'])->name('menu');
});


Route::get('/user/notification', [UserNotification::class, 'index'])->name('user.notification');

Route::prefix('reservations/preorder/{reservation}')->name('preorder.')->group(function () {
    Route::get('/', [PreorderController::class, 'index'])->name('index');
    Route::post('/', [PreorderController::class, 'store'])->name('store');
    Route::get('/show', [PreorderController::class, 'show'])->name('show');
    Route::post('/confirm', [PreorderController::class, 'confirm'])->name('confirm');
    Route::delete('/', [PreorderController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::patch('/payment/{id}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::post('/payment/{id}/terapkan-promo', [PaymentController::class, 'terapkanPromo'])->name('payment.terapkanPromo');
});

Route::get('/history', [HistoryController::class, 'index'])
    ->name('history');

//======Route Owner=======

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

Route::prefix('owner/reservations')->name('owner.reservations.')->group(function () {
    Route::get('/', [ReservationManageController::class, 'index'])->name('index');
    Route::post('/', [ReservationManageController::class, 'store'])->name('store');
    Route::get('/data', [ReservationManageController::class, 'getData'])->name('data');
    Route::delete('/last', [ReservationManageController::class, 'destroyLast'])->name('destroyLast');
    Route::post('/{id}/assign-meja', [ReservationManageController::class, 'assignMeja'])->name('assign-meja');
    Route::patch('/{id}/selesai', [ReservationManageController::class, 'markAsSelesai'])->name('markAsSelesai');
});

Route::prefix('owner/orders')->name('orders.')->group(function () {
    Route::get('/{id}', [OrderManageController::class, 'index'])->name('index');
    Route::patch('/update-status', [OrderManageController::class, 'updateStatus'])->name('updateStatus');
});

Route::get('/owner/settings', [SettingController::class, 'index'])
    ->name('setting.index');

Route::prefix('owner/dashboard/pesanan')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('pesanan.index');
});

Route::prefix('owner/dashboard/promo')->name('owner.promos.')->group(function () {
    Route::get('/', [PromoController::class, 'index'])->name('index');
    Route::get('/tambah', [PromoController::class, 'create'])->name('create');
    Route::post('/', [PromoController::class, 'store'])->name('store');
    Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
    Route::put('/{promo}', [PromoController::class, 'update'])->name('update');
    Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('destroy');
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

Route::get('/owner/premium', [PremiumController::class, 'index'])->name('premium');

Route::prefix('owner')->name('owner.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard/notification', [NotificationController::class, 'index'])
        ->name('notification');
    Route::post('/notification/reminder', [OrderManageController::class, 'sendReminder'])
        ->name('notification.reminder');
    Route::post('/notification/pickup', [OrderManageController::class, 'notifyPickup'])
        ->name('notification.pickup');
});

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/neopayment/{id}/confirm', [NeoPaymentController::class, 'confirm'])->name('neopayment.confirm');
});

Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');

require __DIR__ . '/auth.php';
