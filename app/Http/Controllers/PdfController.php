<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function tagihan()
    {
        $instansi = Instansi::first();
        return view('admin.pdf.tagihan-pdf', compact('instansi'));
    }
    public function pembayaran()
    {
        $instansi = Instansi::first();
        return view('admin.pdf.pembayaran-pdf', compact('instansi'));
    }
    public function spp()
    {
        $instansi = Instansi::first();
        return view('admin.pdf.spp-pdf', compact('instansi'));
    }
}
