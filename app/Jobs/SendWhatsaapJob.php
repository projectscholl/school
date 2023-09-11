<?php

namespace App\Jobs;

use App\Models\Biaya;
use App\Models\Murid;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\User;
use App\Traits\Fonnte;
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
        $biaya = Biaya::with('tagihans')->get();
        // $tagihan = $biaya->tagihans;
        // $user = User::with('murids')->get();

        // $send = "Assalamualaikum Wr.Wb Bapak/Ibu $user->name Kami ingin Mengumumkan Tagihan Untuk Saudara " . $user->murids->name . "." . "<br>" . "Untuk Biaya $biaya->nama_biaya " . " " . "Dengan Total " . $tagihan->amount;
        foreach ($biaya as $biayas) {
            $tagihans = Tagihan::where('id_biayas', $biayas->id)->where('end_date', date('Y-m-d'))->get();
            foreach ($tagihans as $tagihan) {
                $user = murid::with('User')->where('id_angkatans', $biayas->id_angkatans)->where('id_jurusans', $biayas->id_jurusans)->where('id_kelas', $biayas->id_kelas)->get();
                $tagihan = Notify::where('id', 2)->get();
                foreach ($user as $users) {
                    $send =  $tagihan . $users->User->name . "Kami ingin Mengumumkan Tagihan Untuk Saudara " . $users->name . "." . "<br>" . "Untuk Biaya $biayas->nama_biaya " . " " . "Bulan $tagihan->mounth" . "Dengan Total " . $tagihan->amount;
                    $this->send_message($send, $users->User->telepon);
                }
            }
        }
    }
}
