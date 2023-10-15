<?php

namespace App\Jobs;

use App\Models\Biaya;
use App\Models\Murid;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWhatsaapjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Fonnte;

    // public $biaya;
    // /**
    //  * Create a new job instance.
    //  */
    // public function __construct($biaya)
    // {
    //     $this->biaya = $biaya;
    // }

    /**
     * Execute the job.
     */
    public function handle()
    {
        //
        //Whatsaap 
        $biaya = Biaya::with('tagihans')->get();
        // $time = strtotime('-10 days', strtotime($tagihanDetails->end_date . '-' . date('Y')));
        // $times = strtotime($tagihanDetails->end_date . '-' . date('Y')) - (86400 * 10);
        // foreach ($tagihanDetail as $tagihanDetails) {
        //     if ($tagihanDetails->status == 'BELUM') {
        //         $time = strtotime($tagihanDetails->end_date . '-' . date('Y')) - (86400 * 10);
        //         Log::info(time());
        //     }
        // }
        // $date = Carbon::parse(date('Y-m-d'))->format('F');
        // $dates = Carbon::parse('1990-09-09')->format('F');
        // $to = 'adsdad';
        // if ($date == $dates) {
        //     Log::info($dates);
        // }

        //Tagihan mencapai 10 before tenggat
        $tagihanDetail = TagihanDetail::with('tagihan')->where('bulan', date('d-m'))->get();
        foreach ($tagihanDetail as $tagihanDetails) {
            $strtotime = strtotime($tagihanDetails->bulan . '-' . date('Y'));
            if (date('Y-m-d', $strtotime) == date('Y-m-d')) {

                $user = Murid::where('id', $tagihanDetails->id_murids)->get();
                $tagihan = Tagihan::where('id', $tagihanDetails->id_tagihan)->get();
                foreach ($tagihan as $tagihans) {
                    foreach ($user as $users) {
                        $send = 'Asslammualaikum warahmatullahi wabarakatu yang terhormat Bapak / ibu ' . $users->User->name . ' Kami informasikan ada Tagihan ' . $tagihanDetails->id;
                        // Log::info($send);
                        $this->send_message($users->User->telepon, $send);
                    }
                }
            }
        }
    }
}
