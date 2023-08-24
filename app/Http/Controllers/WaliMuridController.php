<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class WaliMuridController extends Controller
{
    public function index()
    {
        $instansi = Instansi::first();
        $user = Auth::user();
        $walimurids = User::where('role', 'WALI')->get();
        return view('admin.walimurid.index', compact('walimurids', 'user','instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instansi = Instansi::first();
        $user = Auth::user();
        $murid = Murid::all();
        return view('admin.walimurid.create', compact('user', 'murid', 'instansi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users',
            'telepon' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,gif',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($request->password);
        $data['role'] = 'WALI';

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/image', $imageName); 
            $data['image'] = '' . $imageName; 
        }

        $user = User::create($data);

        return redirect()->route('admin.walimurid.index')->with('message', 'Wali murid berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $instansi = Instansi::first();
        $user = User::find($id);
        $murid = Murid::all();
        return view('admin.walimurid.detail', compact('user', 'murid', 'instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $instansi = Instansi::first();
        $user = User::find($id);
        return view('admin.walimurid.edit', compact('user', 'instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'max:255|string',
            'email' => 'email|unique:users,email,' . $id,
            'telepon' => 'required|string',
            'password' => 'required',
        ]);
        $user = User::find($id);
        $user->update($data);
        // dd($user);
        return redirect()->route('admin.walimurid.index')->with('pesan', "Data Wali Murid berhasil diperbarui!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $waliMurid =  User::findOrFail($id);
        $waliMurid->delete();
        return redirect()->route('admin.walimurid.index')->with('delete', "Wali Murid Berhasil Dihapus!!");
    }
}
