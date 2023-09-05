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
            'nama_biaya' => 'required|max:50',
            'jenis_biaya' => 'required|in:routine,tidakRoutine',
        ]);

        $data2 = $request->validate([
            'start_date.*' => 'nullable',
            'end_date.*' => 'nullable',
            'mounth.*' => 'nullable',
            'amount.*' => 'required',
            'status' => 'nullable',
        ]);

        $biaya = Biaya::create($data);


        $dateStart = request()->input('start_date');
        $dateEnd =  request()->input('end_date');
        $mounth =  request()->input('mounth');
        $amount = request()->input('amount');
        // dd($dateStart);

        foreach ($amount as $index => $n) {

            $Tagihan = Tagihan::create([
                'id_biayas' => $biaya->id,
                'mounth' => $mounth[$index],
                'amount' => $n,
                'start_date' => $dateStart[$index],
                'end_date' => $dateEnd[$index],
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
    public function edit($id)
    {
        $user = Auth::user();
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');

        $biaya = Biaya::with('tagihans')->find($id);
        $tagihan = Tagihan::where('id_biayas', $id)->get();

        return view('admin.biaya.edit', compact('user', 'angkatan', 'jurusanGrouped', 'kelasGrouped', 'biaya', 'tagihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'id_kelas' => 'required',
            'id_jurusans' => 'required',
            'nama_biaya' => 'required|max:50',
            'jenis_biaya' => 'required|in:routine,tidakRoutine',
        ]);

        $data2 = $request->validate([
            'start_date.*' => 'nullable',
            'end_date.*' => 'nullable',
            'mounth.*' => 'nullable',
            'amount.*' => 'required',
            'status' => 'nullable',
        ]);

        $biaya = Biaya::with('tagihans')->find($id);

        $tagihan = Tagihan::where('id_biayas', $id);


        $dateStart = request()->input('start_date');
        $dateEnd = request()->input('end_date');
        $mounth = request()->input('mounth');
        $amount = request()->input('amount');

        $tagihan->delete();
        if ($request->amount) {
            foreach ($amount as $key => $value) {
                $data1 = [
                    'id_biayas' => $id,
                    'start_date' => $dateStart[$key],
                    'end_date' => $dateEnd[$key],
                    'amount' => $value,
                    'mounth' => $mounth[$key],
                ];
                Tagihan::create($data1);
            }
        }
        $biaya->update($data);



        // dd($result); 

        return redirect()->route('admin.biaya.index')->with('pesan', "Biaya Berhasil Diedit!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $biaya = Biaya::findOrFail($id);
        $tagihan = Tagihan::where('id_biayas', $id);
        $tagihan->delete();
        $biaya->delete();

        return redirect()->route('admin.biaya.index');
    }
}
