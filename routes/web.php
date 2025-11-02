<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\DashboardController;
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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');
});

// Route::get('/search', function () {
//     return view('user.search');
// });

Route::get('/detail', function () {
    return view('user.detail');
})->name('detail');

Route::get('/reservations', function () {
    return view('user.reservations');
})->name('reservations');

Route::get('/preorder', function () {
    return view('user.preorder');
})->name('preorder');

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

Route::get('/history', function () {
    return view('user.history');
})->name('history');


Route::post('/logout', function () {
    // Auth::logout(); // hapus session user
    return redirect()->route('login'); // arahkan ke route login
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
