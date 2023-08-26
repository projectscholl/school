<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index');
    }
    public function create()
    {
        return view('admin.kelas.create');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_angkatan' => 'required',
            'id_jurusans' => 'required',
            'kelas' => 'required',
        ]);

        Kelas::create($validate);
    }
}
