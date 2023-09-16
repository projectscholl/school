<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $pembayarans = Pembayaran::with(['murids', 'murids'])->get();
        return view('admin.pembayaran.index', compact('user', 'instansi', 'pembayarans'));
    }
    public function show(string $id)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $pembayaran = Pembayaran::find($id);
        return view('admin.pembayaran.detail', compact('user', 'instansi', 'pembayaran'));
    }

    public function confirm(Request $request, string $id)
    {
        $pembayaran = Pembayaran::with('tagihanDetails')->find($id);

        if (!$pembayaran) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        foreach ($pembayaran->tagihanDetails as $tagihanDetail) {
            $tagihanDetail->update(['status' => 'SUDAH']);
        }

        $pembayaran->update(['payment_status' => 'Dikonfirmasi']);

        return redirect()->route('admin.pembayaran.index')->with('pesan', 'Pembayaran Berhasil Di Konfirmasi');
    }
}
