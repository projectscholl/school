<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Instansi;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        dd($banks);
        // return view('admin.instansi.index', compact('banks'));
    }

    public function edit(string $id)
    {
        $instansi = Instansi::find($id);
        return view('admin.instansi.bank.edit', compact('instansi'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'no_rekening' => 'required|string',
        ]);

        Bank::create($data);

        return redirect()->route('admin.instansi.index')->with('message', "Data Bank berhasil diperbarui!!");
    }
}
