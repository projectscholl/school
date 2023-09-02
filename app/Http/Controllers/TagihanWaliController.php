<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanWaliController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $anakWaliMurid = $user->murid;
        $tagihan = Biaya::whereIn('id_angkatans', $anakWaliMurid->pluck('id_angkatans'))
        ->whereIn('id_jurusans', $anakWaliMurid->pluck('id_jurusans'))
        ->whereIn('id_kelas', $anakWaliMurid->pluck('id_kelas'))
        ->get();
        // dd($tagihan);
        return view('wali.tagihan.index', compact('instansi', 'tagihan'));
    }

    public function detail(string $id)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $bulan = Tagihan::where('id_biayas', $tagihan->id)->get();
        // dd($tagihan);
        return view('wali.tagihan.detail', compact('instansi', 'tagihan', 'bulan'));
    }
    public function pembayaran(string $id)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $bulan = Tagihan::where('id_biayas', $id)->get();
        return view('wali.tagihan.pembayaran', compact('instansi', 'bulan', 'tagihan'));
    }
    public function pilih_pembayaran(string $id)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $user = Auth::user();
        return view('wali.tagihan.pilih_pembayaran', compact('instansi', 'user', 'tagihan'));
    }
    public function bayar()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.bayar', compact('instansi'));
    }

    public function result()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.result', compact('instansi'));
    }
}
