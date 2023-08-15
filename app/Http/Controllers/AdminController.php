<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahMurid = Murid::count();
        return view('admin.dashboard', compact('user', 'jumlahMurid'));
    }
    public function edit()
    {
        $user = Auth::user();
        return view('admin.user.profile', compact('user'));
    }
}
