<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Instansi;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function edit(string $id)
    {
        $instansi = Instansi::find($id);
        $bank = Bank::find($id);
        return view('admin.instansi.bank.edit', compact('instansi', 'bank'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'no_rekening' => 'required|max:10',
        ]);

        Bank::create($data);

        return redirect()->route('admin.instansi.index')->with('message', "Data Bank berhasil diperbarui!!");
    }
    
}