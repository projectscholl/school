<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileWaliController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        return view('wali.profile-wali', compact('user', 'instansi'));
    }
}
