<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('angkatans', 'jurusans')->get();
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
}
