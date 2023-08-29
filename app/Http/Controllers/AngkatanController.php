<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi = Instansi::first();
        $angkatan = Angkatan::all();
        return view('admin.angkatan.index', compact('angkatan', 'instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instansi = Instansi::first();
        return view('admin.angkatan.create', compact('instansi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required|unique:angkatans,tahun' 
        ], [
            'tahun.unique' => 'Tahun angkatan sudah ada.'
        ]);

        Angkatan::create($data);
        return redirect()->route('admin.angkatan.index')->with('message', "Angkatan Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $angkatan = Angkatan::find($id);
        $instansi = Instansi::first();
        return view('admin.angkatan.edit', compact('angkatan', 'instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tahun' => 'required|unique:angkatans,tahun' 
        ], [
            'tahun.unique' => 'Tahun angkatan sudah ada.'
        ]);

        $angkatan = Angkatan::findOrFail($id);
        $angkatan->update($data);
        return redirect()->route('admin.angkatan.index')->with('pesan', "Angkatan Berhasil Di Update!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $angkatan = Angkatan::findOrFail($id);

        Kelas::where('id_angkatans', $angkatan->id)->delete();
        Kelas::where('id_jurusans', $angkatan->id)->delete();

        Jurusan::where('id_angkatans', $angkatan->id)->delete();

        $angkatan->delete();

        return redirect()->route('admin.angkatan.index');
    }
}
