<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliSiswaController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = Auth::user()->id;
    //     $instansi = Instansi::first();
    //     $wali = Murid::where('id_users', $user);
    //     $angkatans = Angkatan::all();
    //     $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
    //     $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');

    //     // Periksa parameter filter dan terapkan mereka
    //     if ($request->has('id_angkatans')) {
    //         $wali->where('id_angkatans', $request->input('id_angkatans'));
    //     }

    //     if ($request->has('id_jurusans')) {
    //         $wali->where('id_jurusans', $request->input('id_jurusans'));
    //     }

    //     if ($request->has('id_kelas')) {
    //         $wali->where('id_kelas', $request->input('id_kelas'));
    //     }

    //     $wali = $wali->get();

    //     return view('wali.siswa.index', compact('wali', 'instansi', 'jurusanGrouped', 'kelasGrouped', 'angkatans'));
    // }
    // public function index(Request $request)
    // {
    //     $user = Auth::user()->id;
    //     $instansi = Instansi::first();
    //     $angkatans = Angkatan::all();
    //     $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
    //     $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');

    //     // Inisialisasi query untuk mendapatkan data murid
    //     $wali = Murid::where('id_users', $user);

    //     // Menerapkan filter jika ditemukan
    //     if ($request->has('id_angkatans')) {
    //         $wali->where('id_angkatans', $request->input('id_angkatans'));
    //     }

    //     if ($request->has('id_jurusans')) {
    //         $wali->where('id_jurusans', $request->input('id_jurusans'));
    //     }

    //     if ($request->has('id_kelas')) {
    //         $wali->where('id_kelas', $request->input('id_kelas'));
    //     }

    //     // Dapatkan data murid sesuai dengan filter (atau semua jika filter tidak digunakan)
    //     $murids = $wali->get();

    //     return view('wali.siswa.index', compact('wali', 'instansi', 'angkatans', 'jurusanGrouped', 'kelasGrouped', 'murids'));
    // }
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $instansi = Instansi::first();
        $wali = Murid::where('id_users', $user);

        // Ambil filter Angkatan, Jurusan, dan Kelas yang dikirim melalui permintaan HTTP
        $filterAngkatan = $request->input('id_angkatans');
        $filterJurusan = $request->input('id_jurusans');
        $filterKelas = $request->input('id_kelas');

        // Jika filter Angkatan terisi, gunakan dalam query
        if (!empty($filterAngkatan)) {
            $wali->where('id_angkatans', $filterAngkatan);
        }

        // Jika filter Jurusan terisi, gunakan dalam query
        if (!empty($filterJurusan)) {
            $wali->where('id_jurusans', $filterJurusan);
        }

        // Jika filter Kelas terisi, gunakan dalam query
        if (!empty($filterKelas)) {
            $wali->where('id_kelas', $filterKelas);
        }

        $murids = $wali->get();

        $angkatans = Angkatan::all();
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');

        return view('wali.siswa.index', compact('murids', 'user', 'instansi', 'angkatans', 'jurusanGrouped', 'kelasGrouped', 'jurusans', 'kelas'));
    }



    public function show(string $id)
    {
        $instansi = Instansi::first();
        $user = User::find($id);
        $murid = Murid::where('id_users', $user->id)->get();

        return view('wali.siswa.detail', compact('murid', 'instansi', 'user'));
    }
}
