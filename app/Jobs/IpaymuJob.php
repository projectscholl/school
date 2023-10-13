<?php

namespace App\Jobs;

use App\Models\Pembayaran;
use App\Models\User;
use App\Traits\Fonnte;
use App\Traits\Ipaymu;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class IpaymuJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Fonnte;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pembayaran = Pembayaran::all();

        foreach ($pembayaran as $pembayarans) {
            if ($pembayarans->payment_status == 'PENDING') {
                $times  = strtotime($pembayarans->created_at) + (86400 * 1);
                if ($times < time()) {
                    $pembayarans->update([
                        'payment_status' => 'EXPIRED',
                    ]);
                    $user = User::where('id', $pembayarans->id_users)->get();
                    $send = 'Assalamualaikum warahmatullahi wabarakatu yang terhormat Bapak / ibu ' . $user->name . 'Kami informasikan ada pembayaran yang sudah expired jika ingin membayar silahkan membayar ulang';
                    $this->send_message($user->telepon, $send);
                    // Log::info($user);
                }
            }
        }
    }
}
