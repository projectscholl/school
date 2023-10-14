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
        $walimurids = User::where('role', 'WALI')->orderBy('id', 'desc')->get();
        return view('admin.walimurid.index', compact('walimurids', 'user', 'instansi'));
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
        $messages = [
            'telepon.regex' => 'Nomor telepon harus diawali 08'
        ];
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users',
            'telepon' => 'required|min:12|max:12|regex:/^08\d+$/',
            'hubungan' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,gif',
            'password' => 'required',
        ], $messages);

        $data['password'] = Hash::make($request->password);
        $data['role'] = 'WALI';
        $telepon = ltrim($data['telepon'], '0');
        $data['telepon'] = '62' . $telepon;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/image', $imageName);
            $data['image'] = '' . $imageName;
        }

        $user = User::create($data);
        activity()->causedBy(Auth::user())->event('created')->log('User operator ' . auth()->user()->name . ' melakukan tambah data' . $user->name);

        return redirect()->route('admin.walimurid.index')->with('success', 'Wali murid berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $instansi = Instansi::first();
        $user = User::find($id);
        $murids = Murid::where('id_users', $user->id)->get();
        return view('admin.walimurid.detail', compact('user', 'murids', 'instansi'));
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
        $messages = [
            'telepon.regex' => 'Nomor telepon harus diawali 08'
        ];
        $data = $request->validate([
            'name' => 'max:255|string',
            'email' => 'email|unique:users,email,' . $id,
            'telepon' => 'required|min:12|max:12|regex:/^08\d+$/',
            'hubungan' => 'required',
            // 'password' => 'required',
        ], $messages);
        $user = User::find($id);

        $telepon = ltrim($data['telepon'], '0');
        $data['telepon'] = '62' . $telepon;
        // dd($user);
        $user->update($data);
        return redirect()->route('admin.walimurid.index')->with('success', "Data Wali Murid berhasil diperbarui!!");
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;

        $user = User::whereIn('id', $ids);
        $murid = Murid::whereIn('id_users', $ids);
        $murid->update([
            'id_users' => null,
        ]);
        $user->delete();

        return redirect()->route('admin.walimurid.index')->with('success', 'Data W  alimurid berhasil dihapus');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $waliMurid =  User::findOrFail($id);
        $waliMurid->delete();
        return redirect()->route('admin.walimurid.index')->with('success', "Data Walimurid Berhasil Dihapus!!");
    }
}
