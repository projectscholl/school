<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Tagihan;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    use Fonnte;
    public function index()
    {
        $instansi = Instansi::first();
        $user = Auth::user();
        $murids = Murid::all();
        return view('admin.murid.index', compact('murids', 'user', 'instansi'));
    }

    public function create()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        $users = User::where('role', 'WALI')->get();
        return view('admin.murid.create', compact('user', 'users', 'angkatan', 'instansi', 'jurusanGrouped', 'kelasGrouped'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | max:255 | string',
            'nisn' => 'required | max:10',
            'id_users' => 'nullable',
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'id_kelas' => 'required',
            'address' => 'required',
        ]);

        $murid = Murid::create($data);
        $biaya = Biaya::with('tagihans')->where('id_jurusans', $murid->id_jurusans)->where('id_angkatans', $murid->id_angkatans)->where('id_kelas', $murid->id_kelas)->get();
        
        $user = User::with('murids')->where('id', $murid->id_users)->get();


        foreach ($biaya as $key => $biayas) {
            foreach ($biayas->tagihans as $keys => $tagihans) {
                foreach ($user as $waliUser) {
                    if ($tagihans->mounth == null) {
                        $tes1 = "Nama Tagihan : $biayas->nama_biaya : " . "Untuk Murid : " . $waliUser->name . " " . "Total : " . $tagihans->amount . " " . $tagihans->mounth;
                        $this->send_message($murid->telepon, $tes1);
                    } else {
                        $tes2 = "Nama Tagihan : $biayas->nama_biaya : " . "Untuk Murid :  " . $waliUser->name . "  " . "Total : " . $tagihans->amount . " " . "Untuk Bulan : " . $tagihans->mounth;
                        $this->send_message($murid->telepon, $tes2);
                    }
                }
            }
        }

        return redirect()->route('admin.murid.index')->with('message', "Murid Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instansi = Instansi::first();
        $user = Auth::user();
        $murids = Murid::findOrFail($id);
        return view('admin.murid.detail', compact('user', 'murids', 'instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $instansi = Instansi::first();
        $murid = Murid::find($id);
        $users =  User::where('role', 'WALI')->get();
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        $users =  User::where('role', 'WALI')->get();

        return view('admin.murid.edit', compact('murid', 'users', 'angkatan', 'instansi', 'jurusanGrouped', 'kelasGrouped'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'nisn' => 'required|max:10',
            'id_users' => 'nullable',
            'id_jurusans' => 'required',
            'id_angkatans' => 'required',
            'id_kelas' => 'required',
            // 'kelas' => 'required',
            'address' => 'required',
        ]);

        $murid = Murid::find($id);
        $result = $murid->update($data);
        dd($result);

        return redirect()->route('admin.murid.index')->with('pesan', "Murid Berhasil Diedit!!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $murid =  Murid::findOrFail($id);
        $murid->delete();
        return redirect()->route('admin.murid.index');
    }
}
