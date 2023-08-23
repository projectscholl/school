<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $murids = Murid::all();
        return view('admin.murid.index', compact('murids', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        $biaya = Biaya::with('angkatan')->get();
        $users = User::where('role', 'WALI')->get();
        return view('admin.murid.create', compact('user', 'users', 'biaya'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | max:255 | string',
            'nisn' => 'required | max:10',
            'jurusan' => 'required',
            'id_angkatans' => 'required',
            'address' => 'required',
            'kelas' => 'required',
        ]);


        Murid::create($data);
        return redirect()->route('admin.murid.index')->with('message', "Murid Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $murids = Murid::findOrFail($id);
        return view('admin.murid.detail', compact('user', 'murids'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $murid = Murid::find($id);
        $users =  User::where('role', 'WALI')->get();
        $angkatan = Angkatan::all();

        return view('admin.murid.edit', compact('murid', 'users', 'angkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'nisn' => 'required|max:10',
            'id_users' => 'required',
            'jurusan' => 'required',
            'id_angkatans' => 'required',
            'kelas' => 'required',
        ]);

        $murid = Murid::find($id);
        $result = $murid->update($data);
        // dd($result);

        return redirect()->route('admin.murid.index')->with('pesan', "Murid Berhasil Diedit!!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $murid =  Murid::findOrFail($id);
        $murid->delete();
        return redirect()->route('admin.murid.index')->with('delete', "Murid Berhasil Dihapus!!");
    }
}
