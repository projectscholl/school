<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angkatan = Angkatan::all();
        return view('admin.angkatan.index', compact('angkatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.angkatan.create');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $angkatan =  Angkatan::findOrFail($id);
        $angkatan->delete();
        return redirect()->route('admin.angkatan.index')->with('delete', "Angkatan Berhasil Dihapus!!");
    }
}
