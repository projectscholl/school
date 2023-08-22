<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileWaliController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('wali.profile-wali', compact('user'));
    }
}
