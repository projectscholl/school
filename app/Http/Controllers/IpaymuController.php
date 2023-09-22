<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\TagihanDetail;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Http\Request;

class IpaymuController extends Controller
{
    public function notify(Request $request)
    {
        $idTagihan = $request->id_tagihan;
        $sid = $request->sid;
        $status = $request->status;

        $transaction = Pembayaran::where('bukti_transaksi', $sid)->first();
        if ($status == 'berhasil') {


            $transaction->update([
                'payment_status' => $status,
            ]);
            $pembayaranGet = TagihanDetail::where('id_pembayarans', $transaction->id)->get();
            foreach ($pembayaranGet as $pembayarans) {
                $pembayaran = TagihanDetail::where('id', $pembayarans->id);
                $pembayaran->update([
                    'status' => 'SUDAH',
                ]);
            }

            return view('callback.return');
        } else {
            return view('callback.cancel');
        }
    }
}
