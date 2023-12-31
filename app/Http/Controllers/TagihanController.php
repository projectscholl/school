<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        return view('admin.tagihan.index', compact('user', 'instansi'));
    }

    public function create()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $biaya = Biaya::with('angkatans')->get();
        $siswa = Murid::with('biaya')->get();
        $murids = $siswa->pluck('biaya.nama', 'id_angkatans');
        return view('admin.tagihan.create', compact('user', 'biaya', 'murids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //1.Lakukan validation
        //2.Ambil Data siswa yang ditagihakan berdasarkan angkatan
        //4.Lakukan perulangan berdasarkan data siswa
        //5.didalam perulanagan, Simpan Tagihan berdasarkan biaya dana siswa
        //6.Simpan notifikasi database untuk tagihan
        //7.Kirim pesan whatsaap
        //8.Redirict
        $validate = $request->validate([
            'id_murid' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'desc' => 'required',
        ]);
        $idMurid = $validate['id_murid'];
        $murids = Murid::query();
        $murids = $murids->where('id_angkatans', $idMurid)->get();

        $biaya = Murid::with('biaya')->where('id_angkatans', $idMurid)->get();

        foreach ($biaya as $biayas) {
            $dataTagihan = [
                'id_murid' => $biayas->id,
                'nama_biaya' => $biayas->biaya->nama,
                'nama_murid' => $biayas->name,
                'total_biaya' => $biayas->biaya->total_biaya,
                'desc' => $validate['desc'],
                'start_date' => $validate['start_date'],
                'end_date' => $validate['end_date'],

            ];


            print_r($dataTagihan);
            echo '<br>';
        }





        dd($validate);
        // $tagihanDetail = TagihanDetail::create([
        //     'id_tagihan' => ,
        // ]);





    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        return view('admin.tagihan.detail', compact('user', 'instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bayarIpaymu($id)
    {
        return view('admin.tagihan.bayar');
    }
}
