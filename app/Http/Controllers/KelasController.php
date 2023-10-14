<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('angkatans', 'jurusans')->orderBy('created_at', 'desc')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');

        return view('admin.kelas.create', compact('angkatan', 'jurusanGrouped'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'kelas' => 'required',
        ]);

        Kelas::create($validate);

        return redirect()->route('admin.kelas.index')->with('message', "Kelas Berhasil Ditambahkan!!");
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $angkatan = Angkatan::all();

        return view('admin.kelas.edit', compact('angkatan', 'jurusanGrouped', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'kelas' => 'required',
        ]);

        $class = Kelas::find($id);

        $class->update($data);

        return redirect()->route('admin.kelas.index')->with('edit', "Kelas Berhasil Diupdate!!");;
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;
        $kelas = Kelas::whereIn('id', $ids);
        $biayat = Biaya::where('id_kelas', $ids)->first();
        $murids = Murid::where('id_kelas', $ids)->first();


        if ($biayat) {
            foreach ($ids as $id) {
                $biaya = Biaya::where('id_kelas', $id)->get();
                foreach ($biaya as $biayas) {
                    return redirect()->route('admin.kelas.index')->with('pesan', 'Gagal Menghapus data kelas ! Hapus data biaya dengan kelas ' . $biayas->kelas->kelas . ' terlebih dahulu');
                }
            }
        } else if ($murids) {
            return redirect()->route('admin.kelas.index')->with('pesan', 'Gagal Menghapus data kelas ! Hapus data murid dengan kelas ' . $murids->kelas->kelas . ' terlebih dahulu');
        } else {
            $kelas->delete();
            return redirect()->route('admin.kelas.index')->with('success', 'Success Delete data ');
        }
    }

    public function destroy(string $id)
    {

        $kelas = Kelas::findOrFail($id);
        $biaya = Biaya::where('id_kelas', $kelas->id)->first();
        $murids = Murid::where('id_jurusans', $kelas->id)->first();

        if ($biaya) {
            return redirect()->route('admin.kelas.index')->with('pesan', 'Gagal Menghapus data! Hapus data Biaya kelas ' . $biaya->kelas->kelas . ' terlebih dahulu');
        } else if ($murids) {
            return redirect()->route('admin.jurusan.index')->with('pesan', 'Gagal Menghapus data kelas! Hapus data Murid jurusan ' . $murids->jurusans->nama . ' terlebih dahulu');
        } else {
            $kelas->delete();
            return redirect()->route('admin.kelas.index');
        }
    }
}
