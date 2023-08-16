<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagihanWaliController extends Controller
{
    public function index()
    {
        return view('wali.tagihan.index');
    }

    public function detail()
    {
        return view('wali.tagihan.detail');
    }

    public function bayar()
    {
        return view('wali.tagihan.bayar');
    }
}
