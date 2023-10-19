<?php

namespace App\Console\Commands;

use App\Models\TagihanDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Nunggak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:nunggak';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tagihanDetails = TagihanDetail::all();

        foreach ($tagihanDetails as $tagihanDetail) {

            // if (date('m', strtotime($tagihanDetail->end_date . '-' . date('Y'))) === '07' || date('m', strtotime($tagihanDetail->end_date . '-' . date('Y'))) === '08' || date('m', strtotime($tagihanDetail->end_date . '-' . date('Y'))) === '09' || date('m', strtotime($tagihanDetail->end_date . '-' . date('Y'))) === '10' || date('m', strtotime($tagihanDetail->end_date . '-' . date('Y'))) === '11' || date('m', strtotime($tagihanDetail->end_date . '-' . date('Y'))) === '12') {
            //     $tunggak = strtotime($tagihanDetail->end_date . '-' . date('Y'));
            // } else {
            //     $tunggak = strtotime($tagihanDetail->end_date . '-' . date('Y') + 1);
            // }
            $tunggak = strtotime($tagihanDetail->end_date);

            $waktuFormat = date('Y-m-d', $tunggak);
            Log::info($waktuFormat);
            // $date = date('Y-m-d', $tunggak);
            if ($waktuFormat < date('Y-m-d') && $tagihanDetail->status == 'BELUM') {
                $end_date = Carbon::parse($waktuFormat)->format('d-m-Y');
                TagihanDetail::where('end_date', $end_date)->update([
                    'status' => 'NUNGGAK',
                ]);
                // TagihanDetail::where('end_date', date('m-d'))->update([
                //     'status' => 'NUNGGAK',
                // ]);
            }
        }
    }
}
