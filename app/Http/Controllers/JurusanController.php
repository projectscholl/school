<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi = Instansi::first();
        $jurusans = Jurusan::with('angkatans')->get();
        return view('admin.jurusan.index', compact('instansi', 'jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instansi = Instansi::first();
        $angkatan = Angkatan::get();
        return view('admin.jurusan.create', compact('instansi', 'angkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'nama' => 'required|max:255'
        ]);
        Jurusan::create($data);
        return redirect()->route('admin.jurusan.index')->with('success', "Jurusan Berhasil Di Buat!!");
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
        $angkatan = Angkatan::all();
        $instansi = Instansi::first();
        $jurusan = Jurusan::find($id);
        return view('admin.jurusan.edit', compact('angkatan', 'instansi', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'nama' => 'required|max:255'
        ]);
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($data);
        return redirect()->route('admin.jurusan.index')->with('success', "Jurusan Berhasil Di Update!!");
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;
        $jurusan = Jurusan::whereIn('id', $ids);
        $biayat = Biaya::where('id_jurusans', $ids)->first();
        $murids = Murid::where('id_jurusans', $ids)->first();


        if ($biayat) {
            foreach ($ids as $id) {
                $biaya = Biaya::where('id_jurusans', $id)->get();
                foreach ($biaya as $biayas) {
                    return redirect()->route('admin.kelas.index')->with('pesan', 'Gagal Menghapus data ! Hapus data biaya dengan jurusan ' . $biayas->jurusans->nama . ' terlebih dahulu');
                }
            }
        } else if ($murids) {
            return redirect()->route('admin.jurusan.index')->with('pesan', 'Gagal Menghapus data jurusan! Hapus data Murid jurusan ' . $murids->jurusans->nama . ' terlebih dahulu');
        } else {
            Kelas::whereIn('id_jurusans', $ids)->delete();
            $jurusan->delete();
            return redirect()->route('admin.jurusan.index')->with('success', 'Success Delete data ');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $biaya = Biaya::where('id_jurusans', $jurusan->id)->first();
        $murids = Murid::where('id_jurusans', $jurusan->id)->first();

        if ($biaya) {
            return redirect()->route('admin.jurusan.index')->with('pesan', 'Gagal Menghapus data! Hapus Data Biaya dengan jurusan ' . $biaya->jurusans->nama . ' terlebih dahulu');
        } else if ($murids) {
            return redirect()->route('admin.jurusan.index')->with('pesan', 'Gagal Menghapus data jurusan! Hapus data Murid jurusan ' . $murids->jurusans->nama . ' terlebih dahulu');
        } else {
            Kelas::where('id_jurusans', $jurusan->id)->delete();
            $jurusan->delete();

            return redirect()->route('admin.jurusan.index')->with('success', 'Berhasil menghapus data jurusan ' . $jurusan->nama);
        }
    }
}
