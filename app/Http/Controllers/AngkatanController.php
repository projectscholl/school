<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi = Instansi::first();
        $angkatan = Angkatan::orderBy('created_at', 'desc')->get();
        return view('admin.angkatan.index', compact('angkatan', 'instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instansi = Instansi::first();
        return view('admin.angkatan.create', compact('instansi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required|unique:angkatans,tahun'
        ], [
            'tahun.unique' => 'Tahun angkatan sudah ada.'
        ]);

        Angkatan::create($data);
        return redirect()->route('admin.angkatan.index')->with('message', "Angkatan Berhasil Ditambahkan!!");
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
        $angkatan = Angkatan::find($id);
        $instansi = Instansi::first();
        return view('admin.angkatan.edit', compact('angkatan', 'instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tahun' => 'required|unique:angkatans,tahun'
        ], [
            'tahun.unique' => 'Tahun angkatan sudah ada.'
        ]);

        $angkatan = Angkatan::findOrFail($id);
        $angkatan->update($data);
        return redirect()->route('admin.angkatan.index')->with('pesan', "Angkatan Berhasil Di Update!!");
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;
        $angkatan = Angkatan::whereIn('id', $ids);
        $biayat = Biaya::whereIn('id_angkatans', $ids)->first();
        $murids = Murid::whereIn('id_angkatans', $ids)->first();


        if ($biayat) {
            foreach ($ids as $id) {
                $biaya = Biaya::where('id_angkatans', $id)->get();
                foreach ($biaya as $biayas) {
                    return redirect()->route('admin.angkatan.index')->with('pesan', 'Gagal Menghapus data ! Hapus data Biaya angkatan ' . $biayas->angkatans->tahun . ' terlebih dahulu');
                }
            }
        } else if ($murids) {
            foreach ($ids as $id) {
                $murids = Murid::where('id_angkatans', $ids)->get();
                foreach ($murids as $murid) {
                    return redirect()->route('admin.angkatan.index')->with('pesan', 'Gagal Menghapus data ! Hapus data murid angkatan ' . $murid->angkatans->tahun . ' terlebih dahulu');
                }
            }
        } else {
            Kelas::whereIn('id_angkatans', $ids)->delete();
            Jurusan::whereIn('id_angkatans', $ids)->delete();
            $angkatan->delete();
            return redirect()->route('admin.angkatan.index')->with('success', 'success Delete data ');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        $biaya = Biaya::where('id_angkatans', $angkatan->id)->first();
        $murids = Murid::where('id_angkatans', $angkatan->id)->first();
        if ($biaya) {
            return redirect()->route('admin.angkatan.index')->with('pesan', 'Gagal Menghapus data ! Hapus data Biaya angkatan ' . $biaya->angkatans->tahun . ' terlebih dahulu');
        } else if ($murids) {
            return redirect()->route('admin.angkatan.index')->with('pesan', 'Gagal Menghapus data ! Hapus data Murid angkatan ' . $murids->angkatans->tahun . ' terlebih dahulu');
        } else {
            Kelas::where('id_angkatans', $angkatan->id)->delete();
            Jurusan::where('id_angkatans', $angkatan->id)->delete();

            $angkatan->delete();

            return redirect()->route('admin.angkatan.index')->with('success', 'success Delete data ');;
        }
    }
}
