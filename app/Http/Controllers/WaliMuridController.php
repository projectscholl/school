<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.walimurid.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.walimurid.detail', compact('user'));
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
        'name' => 'required|max:255|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'telepon' => 'required|string',
        'password' => 'required',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/storage/image');
        $data['image'] = $imagePath;
    }

    $data['password'] = bcrypt($data['password']);

    $user = User::findOrFail($id);
    $user->update($data);
    // dd($data);
    return redirect()->route('admin.walimurid.index')->with('pesan', "Data Wali Murid berhasil diperbarui!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
