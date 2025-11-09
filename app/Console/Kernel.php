<?php

namespace App\Console;

use App\Models\Owner;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Owner::whereNotNull('tier_end_at')
                ->where('tier_end_at', '<', now())
                ->update([
                    'tier' => 'subs',
                    'tier_start_at' => null,
                    'tier_end_at' => null,
                ]);
        })->daily();
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
