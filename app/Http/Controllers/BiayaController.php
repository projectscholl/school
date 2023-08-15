<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiayaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.biaya.index', compact('user'));
    }

    public function create()
    {
        $user = Auth::user();
        $angkatan = Angkatan::all();
        return view('admin.biaya.create', compact('user', 'angkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'id_angkatans' => 'required',
            'total_biaya' => 'required',
        ]);

        Biaya::create($data);
        return redirect()->route('admin.biaya.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        return view('admin.biaya.edit', compact('user'));
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
        //
    }
}
