<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WaliMuridController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $walimurids = User::where('role', 'WALI')->get();
        return view('admin.walimurid.index', compact('walimurids', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $murid = Murid::all();
        return view('admin.walimurid.create', compact('user', 'murid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | max:255 | string',
            'email' => 'required | email | unique:users',
            'telepon' => 'required | string',
            'image' => 'nullable | mimes:jpeg,png,gif',
            'password' => 'required',
        ]);
        // dd($data);
        
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'WALI';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/storage/image');
            $data['image'] = $imagePath;
        }

        User::create($data);
        return redirect()->route('admin.walimurid.index')->with('message', 'Wali murid berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $murid = Murid::all();
        return view('admin.walimurid.detail', compact('user', 'murid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.walimurid.edit', compact('user'));
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
