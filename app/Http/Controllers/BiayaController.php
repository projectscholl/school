<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiayaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $biaya = Biaya::with('angkatans')->get();
        return view('admin.biaya.index', compact('user', 'biaya', 'instansi'));
    }

    public function create()
    {
        $user = Auth::user();
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        return view('admin.biaya.create', compact('user', 'angkatan', 'jurusanGrouped', 'kelasGrouped'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'id_kelas' => 'required',
            'id_jurusans' => 'required',
            'nama_biaya' => 'required',
            'jenis_biaya' => 'required',
        ]);

        $data2 = $request->validate([
            'start_date.*' => 'nullable',
            'end_date.*' => 'nullable',
            'amount.*' => 'required',
            'status' => 'nullable',
        ]);

        $biaya = Biaya::create($data);


        $date = request()->input('start_date');
        $dateEnd =  request()->input('end_date');
        $amount = request()->input('amount');

        foreach ($amount as $index => $n) {
            $Tagihan = Tagihan::create([
                'id_biayas' => $biaya->id,
                'amount' => $n,
                'start_date' => $date[$index],
                'end_date' => $dateEnd[$index],
                'status' => $request->status,
            ]);
        }





        return redirect()->route('admin.biaya.index')->with('message', "Biaya Berhasil Dibuat!!!");
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
        $instansi = Instansi::first();
        $biaya = Biaya::find($id);
        $angkatan = Angkatan::all();
        return view('admin.biaya.edit', compact('biaya', 'angkatan', 'instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'id_angkatans' => 'required',
            'total_biaya' => 'required',
        ]);

        $biaya = Biaya::findOrFail($id);
        $result = $biaya->update($data);
        // dd($result);

        return redirect()->route('admin.biaya.index')->with('pesan', "Biaya Berhasil Diedit!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $biaya = Biaya::findOrFail($id);
        $biaya->delete();
        return redirect()->route('admin.biaya.index')->with('delete', "Biaya Berhasil Dihapus!!");
    }
}
