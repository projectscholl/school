<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::first();
        $banks = Bank::all();
        return view('admin.instansi.index', compact('instansi', 'banks'));
    }

    public function edit(string $id)
    {
        $instansi = Instansi::find($id);
        return view('admin.instansi.index', compact('instansi'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'no_rekening' => 'required|max:16|min:16',
        ]);

        Bank::create($data);

        return redirect()->route('admin.instansi.index')->with('success', "Data Bank berhasil Di tambah!!");
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'logo' => 'nullable|mimes:jpeg,png',
            'name' => 'required|max:255',
            'telepon' => 'required|string',
            'tanda_tangan' => 'nullable|mimes:jpeg,png',
            'email' => 'required|email|unique:instansis,email,' . $id,
            'alamat' => 'required|string',
        ]);

        $instansi = Instansi::find($id);

        if ($request->hasFile('logo')) {
            if ($instansi->logo) {
                Storage::delete($instansi->logo);
            }
            $content = $request->file('logo');
            $imageName = time() . '.' . $content->extension();
            $path = 'image/' . $imageName;
            Storage::disk('public')->put($path, file_get_contents($content));
            $data['logo'] = $imageName;
        }

        if ($request->hasFile('tanda_tangan')) {
            if ($instansi->tanda_tangan) {
                Storage::delete($instansi->tanda_tangan);
            }

            $content = $request->file('tanda_tangan');
            $imageName = time() . '.' . $content->extension();
            $path = 'image/' . $imageName;
            Storage::disk('public')->put($path, file_get_contents($content));
            $data['tanda_tangan'] = $imageName;
        }

        $instansi->update($data);

        return redirect()->route('admin.instansi.index')->with('success', "Data Instansi berhasil diperbarui!!");
    }
    public function destroy(string $Id)
    {
        $bank = Bank::findOrFail($Id);
        $bank->delete();
        return redirect()->route('admin.instansi.index')->with('success', "Data Bank berhasil Di Hapus!!");
    }
}
