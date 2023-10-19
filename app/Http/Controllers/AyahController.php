<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Orangtua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AyahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ayah = Orangtua::where('sebagai', 'Ayah')->get();

        return view('admin.ayah.index', compact('ayah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ayah.create');
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
            'email' => 'required|unique:orangtuas,email',
            'telepon' => 'required|min:12|max:12|regex:/^08\d+$/',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);

        $phone = ltrim($request->telepon, '0');
        $phone = '62' . $phone;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/image'), $imageName);
            $create = Orangtua::create([
                'name' => $request->name,
                'email' => $request->email,
                'telepon' => $phone,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'pendidikan' => $request->pendidikan,
                'status' => 1,
                'sebagai' => 'Ayah',
                'image' => $imageName,
            ]);
        } else {
            $create = Orangtua::create([
                'name' => $request->name,
                'email' => $request->email,
                'telepon' => $phone,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'pendidikan' => $request->pendidikan,
                'status' => 1,
                'sebagai' => 'Ayah',
            ]);
        }

        if ($create) {
            return redirect()->route('admin.AyahMurid.index')->with('success', 'Berhasil Membuat Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ayah = Orangtua::find($id);
        $anak = Murid::where('id_ayah', $id)->get();

        return view('admin.ayah.detail', compact('ayah', 'anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ayah = Orangtua::find($id);
        $wali = User::where('id_orangtua', $id)->first();
        // dd($id);

        return view('admin.ayah.edit', compact('ayah', 'wali'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $ayah = Orangtua::find($id);
        $messages = [
            'telepon.regex' => 'Nomor telepon harus diawali 08'
        ];
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:orangtuas,email,' . $ayah['id'],
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
            $ayah->image;
        }
        $telepon = ltrim($data['telepon'], '0');
        $data['telepon'] = '62' . $telepon;

        $ayah->update($data);

        return redirect()->route('admin.AyahMurid.index')->with('success', 'Berhasil mengubah data ' . $ayah->name);
    }
    public function status($userId)
    {
        $user = Orangtua::find($userId);

        if ($user) {
            if ($user->status) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->save();
        }
        return back();
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Orangtua::whereIn('id', $ids)->delete();
    }
    public function role(Request $request, $roleId)
    {
        $ayah = Orangtua::find($roleId);

        $data = $request->validate([
            'name' => 'unique:users,name',
            'password' => 'required'
        ]);
        if ($ayah->status == 1) {
            $create = User::create([
                'name' => $ayah->name,
                'id_orangtua' => $ayah->id,
                'password' => Hash::make($request->password),
                'email' => $ayah->email,
                'role' => 'WALI',
                'status' => 1,
                'telepon' => $ayah->telepon,
                'hubungan' => $ayah->sebagai,
                'agama' => $ayah->agama,
                'pekerjaan' => $ayah->pekerjaan,
                'pendidikan' => $ayah->pendidikan,
                'alamat' => $ayah->alamat,

            ]);
            return redirect()->back()->with('success', 'Berhasil menjadikan ' . $ayah->name . ' walimurid');
        } else {
            return redirect()->back()->with('error', 'Gagal menjadikan ' . $ayah->name . ' walimurid, Pastikan status Aktif');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ayah = Orangtua::find($id);

        $murid = Murid::where('id_ayah', $ayah->id);
        $murid->update([
            'id_ayah' => null,
        ]);
        $ayah->delete();

        return redirect()->back()->with('success', 'Data ayah ' . $ayah->name . ' berhasil dihapus');
    }
}
