<?php

namespace App\Http\Controllers;

use App\Exports\MuridExport;
use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Notify;
use App\Models\Orangtua;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $muridFirst = $muridAll->first();

        $angkatans = Angkatan::all();
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');




        return view('admin.murid.index', compact('filterAngkatan', 'filterJurusan', 'filterKelas', 'muridFirst', 'muridAll', 'murids', 'user', 'instansi', 'angkatans', 'jurusanGrouped', 'kelasGrouped'));
        // return view('admin.murid.laporanMurid', compact('muridAll', 'murids', 'user', 'instansi', 'angkatans', 'jurusanGrouped', 'kelasGrouped'));
    }

    public function create()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        $users = User::where('role', 'WALI')->get();
        $ayah = Orangtua::where('sebagai', 'Ayah')->get();
        $ibu = Orangtua::where('sebagai', 'Ibu')->get();
        // $user = User::where('status')
        return view('admin.murid.create', compact('ibu', 'ayah', 'user', 'users', 'angkatan', 'instansi', 'jurusanGrouped', 'kelasGrouped'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | max:255 | string',
            'nisn' => 'required | max:10',
            'agama' => 'required | max:255',
            'jenis_kelamin' => 'required | max:30',
            'tanggal_lahir' => 'required',
            'id_users' => 'nullable',
            'id_ayah' => 'nullable',
            'id_ibu' => 'nullable',
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'id_kelas' => 'required',
            'address' => 'required',
        ]);

        $murid = Murid::create($data);
        $biaya = Biaya::with('tagihans')->where('id_jurusans', $murid->id_jurusans)->where('id_angkatans', $murid->id_angkatans)->where('id_kelas', $murid->id_kelas)->get();
        foreach ($biaya as $biayas) {
            $tagihans = Tagihan::where('id_biayas', $biayas->id)->get();
            $tenggat = Notify::where('id', 4)->first();
            foreach ($tagihans as $tagihan) {
                $end_date = strtotime($tenggat->notif, strtotime($tagihan->end_date . '-' . date('Y'))); // foreach ($valid as $index => $n) {
                $end_dates = date('d-m', $end_date);
                $tagihanDetail = TagihanDetail::create([
                    'id_tagihan' => $tagihan->id,
                    'id_murids' => $murid->id,
                    'start_date' => $tagihan->start_date,
                    'end_date' => $tagihan->end_date,
                    'nama_biaya' => $biayas->nama_biaya,
                    'jumlah_biaya' => $tagihan->amount,
                    'bulan' => $end_dates,
                ]);
            }
        }

        // $user = User::with('murids')->where('id', $murid->id_users)->get();


        // foreach ($biaya as $key => $biayas) {
        //     foreach ($biayas->tagihans as $keys => $tagihans) {
        //         foreach ($user as $waliUser) {
        //             if ($tagihans->mounth == null) {
        //                 $tes1 = "Nama Tagihan : $biayas->nama_biaya : " . "Untuk Murid : " . $waliUser->name . " " . "Total : " . $tagihans->amount . " " . $tagihans->mounth;
        //                 $this->send_message($murid->telepon, $tes1);
        //             } else {
        //                 $tes2 = "Nama Tagihan : $biayas->nama_biaya : " . "Untuk Murid :  " . $waliUser->name . "  " . "Total : " . $tagihans->amount . " " . "Untuk Bulan : " . $tagihans->mounth;
        //                 $this->send_message($murid->telepon, $tes2);
        //             }
        //         }
        //     }
        // }

        return redirect()->route('admin.murid.index')->with('success', "Murid Berhasil Ditambahkan!!");
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
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        $users = User::where('role', 'WALI')->get();
        $ayah = Orangtua::where('sebagai', 'Ayah')->get();
        $ibu = Orangtua::where('sebagai', 'Ibu')->get();

        return view('admin.murid.edit', compact('ayah', 'ibu', 'murid', 'users', 'angkatan', 'instansi', 'jurusanGrouped', 'kelasGrouped'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required | max:255 | string',
            'nisn' => 'required | max:10',
            'agama' => 'required | max:255',
            'jenis_kelamin' => 'required | max:30',
            'tanggal_lahir' => 'required',
            'id_users' => 'nullable',
            'id_ayah' => 'nullable',
            'id_ibu' => 'nullable',
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'id_kelas' => 'required',
            'address' => 'required',
        ]);

        //Update Dahulu data nya
        $murid = Murid::find($id);
        $murid->update($data);

        //Delete data
        $tagihanDetails = TagihanDetail::where('id_murids', $murid->id);
        $tagihanDetails->delete();
        //Buat Datanya
        $biaya = Biaya::with('tagihans')->where('id_jurusans', $murid->id_jurusans)->where('id_angkatans', $murid->id_angkatans)->where('id_kelas', $murid->id_kelas)->get();
        foreach ($biaya as $biayas) {
            $tagihans = Tagihan::where('id_biayas', $biayas->id)->get();
            foreach ($tagihans as $tagihan) {
                $end_date = strtotime('-10 days', strtotime($tagihan->end_date . '-' . date('Y'))); // foreach ($valid as $index => $n) {
                $end_dates = date('d-m', $end_date);
                $tagihanDetail = TagihanDetail::create([
                    'id_tagihan' => $tagihan->id,
                    'id_murids' => $murid->id,
                    'start_date' => $tagihan->start_date,
                    'end_date' => $tagihan->end_date,
                    'nama_biaya' => $biayas->nama_biaya,
                    'jumlah_biaya' => $tagihan->amount,
                    'bulan' => $end_dates,
                ]);
            }
        }

        return redirect()->route('admin.murid.index')->with('success', "Murid Berhasil Diedit!!");
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;
        $murid = Murid::whereIn('id', $ids);
        $tagihanDetails = TagihanDetail::whereIn('id_murids', $ids);
        $tagihanDetails->delete();
        $murid->delete();
    }

    public function export(Request $request)
    {
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
        $data = [];
        foreach ($murids as $keys => $murid) {

            $data[] = [
                'NO' => $keys + 1,
                'NAMA WALI' => $murid->User->name,
                'NAMA' => $murid->name,
                'NAMA AYAH' => $murid->ayahs->name,
                'NAMA IBU' => $murid->ibus->name,
                'ANGKATAN MURID' => $murid->angkatans->tahun,
                'JURUSAN MURID' => $murid->jurusans->nama,
                'KELAS' => $murid->kelas->kelas,
            ];
        }
        return Excel::download(new MuridExport($data), 'Exportmurid' . date('Y') . '.csv');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $murid =  Murid::findOrFail($id);
        $tagihanDetail = TagihanDetail::where('id_murids', $id)->get();
        if ($tagihanDetail) {
            foreach ($tagihanDetail as $tagihanDetailk) {
                $tagihanDetails = TagihanDetail::where('id', $tagihanDetailk->id);
                $tagihanDetails->delete();
            }
        }

        $murid->delete();
        return redirect()->route('admin.murid.index');
    }

    // public function export()
    // {
    //     return Excel::download(new MuridExport, 'murids.xlsx');
    // }
}
