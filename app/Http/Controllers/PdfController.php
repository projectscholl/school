<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function tagihan()
    {
        return view('admin.pdf.tagihan-pdf');
    }
    public function pembayaran()
    {
        return view('admin.pdf.pembayaran-pdf');
    }
}
