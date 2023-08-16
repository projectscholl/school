<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use Illuminate\Support\Facades\Auth;

class WaliSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $wali = Murid::where('id_users',$user)->get();
        return view('wali.siswa.index', compact('wali'));
    }
}
