<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class TagihanWaliController extends Controller
{
    public function index()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.index', compact('instansi'));
    }

    public function detail()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.detail', compact('instansi'));
    }
    public function pembayaran()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.pembayaran', compact('instansi'));
    }
    public function pilih_pembayaran()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.pilih_pembayaran', compact('instansi'));
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
