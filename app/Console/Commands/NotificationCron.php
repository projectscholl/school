<?php

namespace App\Console\Commands;

use App\Models\Biaya;
use App\Models\Murid;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\Job;
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
        $biaya = Biaya::with('tagihans')->get();
        // $tagihan = $biaya->tagihans;
        // $user = User::with('murids')->get();

        // $send = "Assalamualaikum Wr.Wb Bapak/Ibu $user->name Kami ingin Mengumumkan Tagihan Untuk Saudara " . $user->murids->name . "." . "<br>" . "Untuk Biaya $biaya->nama_biaya " . " " . "Dengan Total " . $tagihan->amount;
        foreach ($biaya as $biayas) {
            $tagihans = Tagihan::with('biayas')->where('id_biayas', $biayas->id)->where('end_date', date('Y-m-d'))->get();
            foreach ($tagihans as $tagihan) {
                $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihan->id)->where('end_date', date('Y-m-d'))->where('status', 'BELUM')->get();
                foreach ($tagihanDetail as $tagihansT) {
                    $user = Murid::with('User')->where('id_angkatans', $biayas->id_angkatans)->where('id_jurusans', $biayas->id_jurusans)->where('id_kelas', $biayas->id_kelas)->get();
                    foreach ($user as $users) {
                        $wali = User::where('id', $users->id_users)->get();
                        $notification = Notify::where('id', 2)->get();
                        foreach ($wali as $keys => $walis) {
                            if ($tagihansT->end_date == date('Y-m-d')) {
                                $send = $notification[$keys]->notif . ' ' . $users->name . ' ' . number_format($tagihan->amount, 2, ',', '.') . ' ' . url('http://127.0.0.1:8000/login-wali');
                                $this->send_message($walis->telepon, $send);
                            } else {
                            }
                        }
                    }
                }
            }
        }
        // Log::info($tagihansT->id);
    }
}
