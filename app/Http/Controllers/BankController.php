<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return view('admin.instansi.index');
    }
    public function edit()
    {
        return view('admin.instansi.bank.edit');
    }
}
