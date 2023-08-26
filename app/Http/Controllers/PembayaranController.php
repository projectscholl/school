<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        return view('admin.pembayaran.index', compact('user', 'instansi'));
    }
    public function show()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        return view('admin.pembayaran.detail', compact('user', 'instansi'));
    }
}
