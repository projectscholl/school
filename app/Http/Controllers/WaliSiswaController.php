<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Murid;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WaliSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $instansi = Instansi::first();
        $wali = Murid::where('id_users',$user)->get();
        return view('wali.siswa.index', compact('wali', 'instansi'));
    }
    public function show(string $id)
    {
        $instansi = Instansi::first();
        $user = User::find($id);
        $murid = Murid::where('id_users', $user->id)->get();
        
        return view('wali.siswa.detail', compact('murid', 'instansi', 'user'));
    }

}
