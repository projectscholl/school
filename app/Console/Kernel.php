<?php

namespace App\Console;

use App\Jobs\SendWhatsaapJob;
use App\Traits\Fonnte;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    use Fonnte;
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        Commands\NotificationCron::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('notification:cron')->timezone('Asia/Jakarta')->dailyAt('10.38');
        // $schedule->job(new SendWhatsaapJob())->everyFiveSeconds();
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
