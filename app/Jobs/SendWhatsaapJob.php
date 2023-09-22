<?php

namespace App\Jobs;

use App\Models\Biaya;
use App\Models\Murid;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
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
            $tagihans = Tagihan::with('biayas')->where('id_biayas', $biayas->id)->where('start_date', date('Y-m-d'))->get();
            foreach ($tagihans as $tagihan) {
                $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihan->id)->where('start_date', date('Y-m-d'))->where('status', 'BELUM')->get();
                foreach ($tagihanDetail as $tagihansT) {
                    $user = Murid::with('User')->where('id_angkatans', $biayas->id_angkatans)->where('id_jurusans', $biayas->id_jurusans)->where('id_kelas', $biayas->id_kelas)->get();
                    foreach ($user as $users) {
                        $wali = User::where('id', $users->id_users)->get();
                        $notification = Notify::where('id', 1)->get();
                        foreach ($wali as $keys => $walis) {
                            // Log::info($tagihansT->id);
                            if ($tagihansT->start_date == date('Y-m-d')) {
                                $send = $notification[$keys]->notif . ' ' . $users->name . ' ' . number_format($tagihan->amount, 2, ',', '.') . ' ' . url('http://127.0.0.1:8000/login-wali');
                                $this->send_message($walis->telepon, $send);
                            } else {
                            }
                        }
                    }
                }
            }
        }
    }
}
