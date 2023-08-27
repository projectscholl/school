<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Instansi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi = Instansi::first();
        $jurusans = Jurusan::with('angkatans')->get();
        return view('admin.jurusan.index', compact('instansi', 'jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instansi = Instansi::first();
        $angkatan = Angkatan::get();
        return view('admin.jurusan.create', compact('instansi', 'angkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'nama' => 'required|max:255'
        ]);
        Jurusan::create($data);
        return redirect()->route('admin.jurusan.index')->with('pesan', "Jurusan Berhasil Di Buat!!");
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
        $angkatan = Angkatan::all(); 
        $instansi = Instansi::first();
        $jurusan = Jurusan::find($id);
        return view('admin.jurusan.edit', compact('angkatan', 'instansi', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'nama' => 'required|max:255'
        ]);
        $jurusan = Jurusan::findOrFail($id); 
        $jurusan->update($data);
        return redirect()->route('admin.jurusan.index')->with('edit', "Jurusan Berhasil Di Update!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
