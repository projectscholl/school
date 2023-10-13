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

class TenggatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Fonnte;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //Whatsaap 
        //     $biaya = Biaya::with('tagihans')->get();

        //     foreach ($biaya as $biayas) {
        //         $tagihans = Tagihan::with('biayas')->where('id_biayas', $biayas->id)->where('end_date', date('d-m'))->get();
        //         foreach ($tagihans as $tagihan) {
        //             $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihan->id)->where('end_date', $tagihan->end_date)->where('status', 'BELUM')->get();
        //             foreach ($tagihanDetail as $tagihansT) {
        //                 $user = Murid::with('User')->where('id', $tagihansT->id_murids)->get();
        //                 foreach ($user as $users) {
        //                     $wali = User::where('id', $users->id_users)->get();
        //                     $notification = Notify::where('id', 1)->get();
        //                     foreach ($wali as $keys => $walis) {
        //                         $tanggal = date("j F", strtotime($tagihansT->end_date . '-' . date('Y')));
        //                         $dates = strtotime($tagihansT->end_date . '-' . date('Y')) + (20 * 1);
        //                         if ($tanggal == date("j F")) {
        //                             $send = $notification[$keys]->notif . ' ' . $users->name . ' ' . number_format($tagihan->amount, 2, ',', '.') . ' ' . url('http://127.0.0.1:8000/login-wali');
        //                             $this->send_message($walis->telepon, $send);
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //pas tenggat

        $biaya = Biaya::with('tagihans')->get();

        foreach ($biaya as $biayas) {
            $tagihans = Tagihan::with('biayas')->where('id_biayas', $biayas->id)->where('end_date', date('d-m'))->get();
            foreach ($tagihans as $tagihan) {
                $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihan->id)->where('end_date', $tagihan->end_date)->where('status', 'BELUM')->get();
                foreach ($tagihanDetail as $tagihansT) {
                    $user = Murid::with('User')->where('id', $tagihansT->id_murids)->get();
                    foreach ($user as $users) {
                        $wali = User::where('id', $users->id_users)->get();
                        $notification = Notify::where('id', 2)->get();
                        foreach ($wali as $keys => $walis) {
                            $send = $notification[$keys]->notif . ' ' . $walis->name . ' ' . number_format($tagihan->amount, 2, ',', '.') . ' ' . url('http://127.0.0.1:8000/login-wali');
                            $this->send_message($walis->telepon, $send);
                            // Log::info($walis->telepon);
                        }
                    }
                }
            }
        }
    }
}
