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
        $jurusan = Jurusan::all();
        $angkatan = Angkatan::all();
        return view('admin.kelas.create', compact('jurusan', 'angkatan'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'kelas' => 'required',
        ]);

        Kelas::create($validate);

        return redirect()->route('admin.kelas.index');
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        $jurusan = Jurusan::all();
        $angkatan = Angkatan::all();

        return view('admin.kelas.edit', compact('angkatan', 'jurusan', 'kelas'));
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

        return redirect()->route('admin.kelas.index');
    }
}
