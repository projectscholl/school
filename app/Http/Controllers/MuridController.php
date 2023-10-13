<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    use Fonnte;


    public function index(Request $request)
    {
        $instansi = Instansi::first();
        $user = Auth::user();
        
        $muridAll = Murid::query(); 
        
        $filterAngkatan = $request->input('id_angkatans');
        $filterJurusan = $request->input('id_jurusans');
        $filterKelas = $request->input('id_kelas');
    
        // Terapkan filter ke Query Builder
        if (!empty($filterAngkatan)) {
            $muridAll->where('id_angkatans', $filterAngkatan);
        }
    
        if (!empty($filterJurusan)) {
            $muridAll->where('id_jurusans', $filterJurusan);
        }
    
        if (!empty($filterKelas)) {
            $muridAll->where('id_kelas', $filterKelas);
        }
    
        // Dapatkan hasil query dengan get()
        $muridAll->orderBy('created_at', 'desc');
        $murids = $muridAll->get();
    
        $angkatans = Angkatan::all();
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
    
        return view('admin.murid.index', compact('muridAll', 'murids', 'user', 'instansi', 'angkatans', 'jurusanGrouped', 'kelasGrouped'));
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
        foreach ($biaya as $biayas) {
            $tagihans = Tagihan::where('id_biayas', $biayas->id)->get();
            foreach ($tagihans as $tagihan) {
                $tagihanDetail = TagihanDetail::create([
                    'id_tagihan' => $tagihan->id,
                    'id_murids' => $murid->id,
                    'start_date' => $tagihan->start_date,
                    'end_date' => $tagihan->end_date,
                    'nama_biaya' => $biayas->nama_biaya,
                    'jumlah_biaya' => $tagihan->amount,
                ]);
            }
        }

        $user = User::with('murids')->where('id', $murid->id_users)->get();

        return redirect()->route('admin.murid.index')->with('message', "Murid Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $instansi = Instansi::first();
        $user = Auth::user();
        $murids = Murid::findOrFail($id);
        $biaya = Biaya::with('tagihans')->where('id_angkatans', $murids->id_angkatans)->where('id_jurusans', $murids->id_jurusans)->where('id_kelas', $murids->id_kelas)->get();
        foreach ($biaya as $key => $biayas) {
            $tagihans = Tagihan::where('id_biayas', $biayas->id)->first();
            foreach ($tagihans as $tagihanMurid) {
            }
        }
        $tagihanDetail = TagihanDetail::with('tagihan')->where('id_murids', $murids->id)->get();
        return view('admin.murid.detail', compact('user', 'murids', 'instansi', 'biaya', 'tagihanDetail'));
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
        $jurusan = Jurusan::all(); 
        $kelas = Kelas::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        $users =  User::where('role', 'WALI')->get();

        return view('admin.murid.edit', compact('murid', 'users', 'angkatan', 'instansi', 'jurusanGrouped', 'kelasGrouped', 'jurusan', 'kelas'));
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
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'id_kelas' => 'required',
            'address' => 'required',
        ]);
        // dd($data);
        $murid = Murid::find($id);
        $result = $murid->update($data);

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
