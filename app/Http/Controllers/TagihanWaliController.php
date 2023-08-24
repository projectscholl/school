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
    public function detail2()
    {
        $instansi = Instansi::first();
        return view('wali.tagihan.detail2', compact('instansi'));
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
