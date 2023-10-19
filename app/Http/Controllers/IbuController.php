<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Orangtua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class IbuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ibu = Orangtua::where('sebagai', 'Ibu')->get();
        return view('admin.Ibu.index', compact('ibu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Ibu.create');
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
            'name' => 'required',
            'email' => 'required|unique:orangtuas,email,',
            'telepon' => 'required|min:12|max:12|regex:/^08\d+$/',
            'agama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
        ], $messages);


        $phone = ltrim($request->telepon, '0');
        $phone = '62' . $phone;
        $create = Orangtua::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $phone,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => $request->pendidikan,
            'alamat' => $request->alamat,
            'status' => 1,
            'sebagai' => 'Ibu',
        ]);

        if ($create) {
            return redirect()->route('admin.IbuMurid.index')->with('success', 'Berhasil Membuat Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ibu = Orangtua::find($id);
        $anak = Murid::where('id_ibu', $id)->get();

        return view('admin.Ibu.detail', compact('ibu', 'anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ibu = Orangtua::find($id);
        $wali = User::where('id_orangtua', $id)->first();
        // dd($id);

        return view('admin.Ibu.edit', compact('ibu', 'wali'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ibu = Orangtua::find($id);
        $messages = [
            'telepon.regex' => 'Nomor telepon harus diawali 08'
        ];
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:orangtuas,email,' . $ibu['id'],
            'telepon' => 'required|min:12|max:12|regex:/^08\d+$/',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
        ], $messages);
        if ($request->image) {
            $content = $request->file('image');
            $imageName = time() . '.' . $content->extension();
            $path = 'image/' . $imageName;
            Storage::disk('public')->put($path, file_get_contents($content));
            $data['image'] = $imageName;
        } else {
            $ibu->image;
        }
        $telepon = ltrim($data['telepon'], '0');
        $data['telepon'] = '62' . $telepon;
        $ibu->update($data);

        return redirect()->route('admin.IbuMurid.index')->with('success', 'Berhasil mengubah data ' . $ibu->name);
    }
    public function role(Request $request, $roleId)
    {
        $ibu = Orangtua::find($roleId);

        $data = $request->validate([
            'name' => 'unique:users,name',
            'password' => 'required'
        ]);
        if ($ibu->status == 1) {
            $create = User::create([
                'name' => $ibu->name,
                'id_orangtua' => $ibu->id,
                'password' => Hash::make($request->password),
                'email' => $ibu->email,
                'role' => 'WALI',
                'status' => 1,
                'telepon' => $ibu->telepon,
                'hubungan' => $ibu->sebagai,
                'agama' => $ibu->agama,
                'pekerjaan' => $ibu->pekerjaan,
                'pendidikan' => $ibu->pendidikan,
                'alamat' => $ibu->alamat,

            ]);
            return redirect()->back()->with('success', 'Berhasil menjadikan ' . $ibu->name . ' walimurid');
        } else {
            return redirect()->back()->with('error', 'Gagal menjadikan ' . $ibu->name . ' walimurid, pastikan Ibu masih aktif !');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ibu = Orangtua::find($id);
        $ibu->delete();

        return redirect()->back()->with('success', 'Data ibu ' . $ibu->name . ' berhasil dihapus');
    }
}
