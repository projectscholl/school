<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanWaliController extends Controller
{

    // public function index()
    // {
    //     $user = Auth::user();
    //     $instansi = Instansi::first();
    //     $anakWaliMurid = $user->murid;

    //     $biayaItems = collect();

    //     foreach ($anakWaliMurid as $murid) {
    //         $biayaItems = $biayaItems->merge($murid->biayas);
    //     }

    //     return view('wali.tagihan.index', compact('instansi', 'biayaItems'));
    // }

    // public function index()
    // {
    //     $user = Auth::user();
    //     $instansi = Instansi::first();
    //     $murid = $user->murid;

    //     $biayaItems = $murid->biayas;

    //     return view('wali.tagihan.index', compact('instansi', 'biayaItems'));
    // }

    public function index()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $anakWaliMurid = $user->murids;
        $idAngkatan = $anakWaliMurid->pluck('id_angkatans')->toArray();
        $idJurusan = $anakWaliMurid->pluck('id_jurusans')->toArray();
        $idKelas = $anakWaliMurid->pluck('id_kelas')->toArray();


        $biayaItems = Biaya::with('angkatans', 'jurusans', 'kelas')
            ->whereIn('id_angkatans', $idAngkatan)
            ->whereIn('id_jurusans', $idJurusan)
            ->whereIn('id_kelas', $idKelas)
            ->get();

        // dd($biayaItems);

        return view('wali.tagihan.index', compact('instansi', 'biayaItems'));
    }

    // public function index()
    // {
    //     $user = Auth::user();
    //     $instansi = Instansi::first();
    //     $murid = $user->murid;

    //     // Mengambil murid dengan biaya dan tagihan mereka
    //     $muridsWithBiayas = $murid->with('biayas.tagihans')->get();

    //     return view('wali.tagihan.index', compact('instansi', 'muridsWithBiayas'));
    // }



    public function detail(string $id, $IdMurid)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $murid = Murid::find($IdMurid);
        $bulan = Tagihan::where('id_biayas', $tagihan->id)->get();
        $confirmedPayments = Pembayaran::where('payment_status');
        return view('wali.tagihan.detail', compact('instansi', 'tagihan', 'bulan', 'murid', 'confirmedPayments'));
    }



    public function pembayaran(string $id, $IdMurid)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $murid = Murid::find($IdMurid);
        $bulan = Tagihan::where('id_tagihans', $tagihan->id)->get();
        return view('wali.tagihan.pembayaran', compact('instansi', 'bulan', 'tagihan', 'murid'));
    }



    public function result($id)
    {
        $instansi = Instansi::first();
        $tagihan = Tagihan::find($id);
        return view('wali.tagihan.result', compact('instansi', 'tagihan'));
    }
}
