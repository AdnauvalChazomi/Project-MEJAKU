<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Kirim data ke semua view 'components.navbar'
        View::composer('components.navbar', function ($view) {
            $user = auth()->user();

            // Ambil ID berdasarkan role user (jika ada relasi owner/customer)
            $ownerId = $user?->owner_id ?? $user?->owner->id ?? null;
            $customerId = $user?->customer_id ?? $user?->customer->id ?? null;

            $view->with(compact('user', 'ownerId', 'customerId'));
        });
    }
}
