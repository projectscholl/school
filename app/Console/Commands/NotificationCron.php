<?php

namespace App\Console\Commands;

use App\Models\Biaya;
use App\Models\Murid;
use App\Models\Tagihan;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationCron extends Command
{
    use Fonnte;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description Berhasil';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //sample


        //Whatsaap 
        
    }
}
