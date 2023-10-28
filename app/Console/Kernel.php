<?php

namespace App\Console;

use App\Jobs\IpaymuJob;
use App\Jobs\SendWhatsaapJob;
use App\Jobs\TenggatJob;
use App\Traits\Fonnte;
use Carbon\Carbon;
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
        Commands\Nunggak::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();


        $time = now()->format('H:i');

        $schedule->command('notification:cron')->dailyAt('22:00');
        $schedule->command('app:nunggak')->everyFourMinutes();

        $schedule->job(new SendWhatsaapJob())->dailyAt('10:12');
        $schedule->job(new TenggatJob())->everyFiveMinutes();
        $schedule->job(new IpaymuJob())->everyFiveMinutes();
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
