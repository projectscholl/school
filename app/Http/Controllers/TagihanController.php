<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
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
        return view('admin.tagihan.index', compact('user'));
    }

    public function create()
    {
        $user = Auth::user();
        $biaya = Biaya::with('angkatans')->get();
        $siswa = Murid::with('angkatan')->get();
        $murids = $siswa->pluck('angkatan.tahun', 'id_angkatans');

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
        $validate = $this->validate($request, [
            'id_angkatans' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        // $tagihanDetail = TagihanDetail::create([
        //     'id_tagihan' => ,
        // ]);





        dd($validate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        return view('admin.tagihan.detail', compact('user'));
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
