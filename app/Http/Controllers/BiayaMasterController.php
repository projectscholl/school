<?php

namespace App\Http\Controllers;

use App\Models\BiayaMaster;
use Illuminate\Http\Request;

class BiayaMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biayaBawaan = BiayaMaster::all();
        return view('admin.biaya.biayaMaster.index', compact('biayaBawaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.biaya.biayaMaster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'harga' => 'required|string|min:5',
        ]);
        $valid = str_replace('.', '', $data['harga']);
        BiayaMaster::create([
            'name' => $data['name'],
            'harga' => $valid,
        ]);
        return redirect()->route('admin.masterBiaya.index')->with('success', 'Berhasil Menambah data');
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

        $biaya = BiayaMaster::find($id);
        return view('admin.biaya.biayaMaster.edit', compact('biaya'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'harga' => 'required|string|min:5',
        ]);
        $valid = str_replace('.', '', $data['harga']);
        BiayaMaster::find($id)->update([
            'name' => $data['name'],
            'harga' => $valid,
        ]);
        return redirect()->route('admin.masterBiaya.index')->with('success', 'Berhasil mengedit data');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        BiayaMaster::whereIn('id', $ids)->delete();
        return redirect()->route('admin.masterBiaya.index')->with('success', 'Berhasil Menghapus data master biaya');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $biayaMaster = BiayaMaster::find($id);

        $biayaMaster->delete();

        return redirect()->route('admin.masterBiaya.index')->with('success', 'Berhasil Menghapus data master biaya');
    }
}
