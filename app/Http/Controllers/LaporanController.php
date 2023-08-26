<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $instansi = Instansi::first();
        return view('admin.laporan.index', compact('instansi'));
    }
}
