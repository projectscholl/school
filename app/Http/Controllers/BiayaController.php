<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\BiayaMaster;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiayaController extends Controller
{
    use Fonnte;
    public function index(Request $request)
    {
        $user = Auth::user();
        $instansi = Instansi::first();

        // Mulai dengan seluruh data Biaya
        $biayas = Biaya::query();

        $filterAngkatan = $request->input('id_angkatans');
        $filterJurusan = $request->input('id_jurusans');
        $filterKelas = $request->input('id_kelas');

        // Terapkan filter Angkatan jika ada
        if (!empty($filterAngkatan)) {
            $biayas->where('id_angkatans', $filterAngkatan);
        }

        // Terapkan filter Jurusan jika ada
        if (!empty($filterJurusan)) {
            $biayas->where('id_jurusans', $filterJurusan);
        }
    
        if (!empty($filterKelas)) {
            $biayas->where('id_kelas', $filterKelas);
        }
        
        $biayas->orderBy('created_at', 'desc')->get();
        $biayaAll = $biayas->get();

        $angkatans = Angkatan::all();
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');

        return view('admin.biaya.index', compact('user', 'biayaAll', 'instansi', 'angkatans', 'jurusanGrouped', 'kelasGrouped', 'jurusans'));
    }



    public function create()
    {
        $user = Auth::user();
        $master = BiayaMaster::all();
        $murids = Murid::first();
        $angkatan = Angkatan::all();
        $angkatans = Angkatan::first();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        $jurusans = Jurusan::with('angkatans')->first();
        $kelas = Kelas::with('jurusans')->first();

        return view('admin.biaya.create', compact('user', 'angkatan', 'jurusanGrouped', 'kelasGrouped', 'master', 'angkatans', 'jurusans', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $minHarga = 10000;
        $data2 = $request->validate([
            'start_date.*' => 'nullable',
            'end_date.*' => 'nullable',
            'mounth.*' => 'nullable',
            'amount.*' => 'required|string|min:5',
            'status' => 'nullable',
        ]);

        $data = $request->validate([
            'id_angkatans' => 'required',
            'id_kelas' => 'required',
            'id_jurusans' => 'required',
            'nama_biaya' => 'required|min:2',
            'jenis_biaya' => 'required|in:routine,tidakRoutine',
        ]);


        $biaya = Biaya::create($data);

        $dateStart = request()->input('start_date');
        $dateEnd = request()->input('end_date');
        $mounth = request()->input('mounth');
        $amount = request()->input('amount');
        // dd($dateStart);
        $muridUser = Murid::with('User')->where('id_jurusans', $biaya->id_jurusans)->where('id_angkatans', $biaya->id_angkatans)->where('id_kelas', $biaya->id_kelas)->get();
        $valid = str_replace('.', '', $amount);

        foreach ($valid as $index => $n) {
            $Tagihan = Tagihan::create([
                'id_biayas' => $biaya->id,
                'mounth' => $mounth[$index],
                'amount' => $n,
                'start_date' => $dateStart[$index],
                'end_date' => $dateEnd[$index],
            ]);
            $murid = Murid::with('User')->where('id_angkatans', $biaya->id_angkatans)->where('id_jurusans', $biaya->id_jurusans)->where('id_kelas', $biaya->id_kelas)->get();
            $tenggat = Notify::where('id', 4)->first();
            foreach ($murid as $key => $murids) {
                $end_date = strtotime($tenggat->notif, strtotime($dateEnd[$index] . '-' . date('Y'))); // foreach ($valid as $index => $n) {
                $end_dates = date('d-m', $end_date);
                // print_r($end_dates);
                TagihanDetail::create([
                    'id_tagihan' => $Tagihan->id,
                    'id_murids' => $murids->id,
                    'start_date' => $dateStart[$index],
                    'end_date' => $dateEnd[$index],
                    'nama_biaya' => $biaya->nama_biaya,
                    'jumlah_biaya' => $n,
                    'bulan' => $end_dates,
                ]);
            }
        }
        return redirect()->route('admin.biaya.index')->withErrors($data2)->with('success', "Biaya Berhasil Dibuat!!!");
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
        $tagihans = Tagihan::where('id_biayas', $id)->first();
        $tagihan = Tagihan::where('id_biayas', $id)->get();

        return view('admin.biaya.edit', compact('user', 'angkatan', 'jurusanGrouped', 'kelasGrouped', 'biaya', 'tagihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
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

        $murid = Murid::with('biayas')->where('id_angkatans', $biaya->id_angkatans)->where('id_jurusans', $biaya->id_jurusans)->where('id_kelas', $biaya->id_kelas)->get();
        $dateStart = request()->input('start_date');
        $dateEnd =  request()->input('end_date');
        $mounth =  request()->input('mounth');
        $amount = request()->input('amount');
        $valid = str_replace('.', '', $amount);
        // $tagihanDetail->delete();
        $ids = $request->id;
        foreach ($ids as $keys => $value) {
            $tagihans = Tagihan::where('id', $ids[$keys]);
            // print_r($ids[$keys]);
            $tagihans->update([
                'id_biayas' => $id,
                'start_date' => $dateStart[$keys],
                'end_date' => $dateEnd[$keys],
                'amount' => $valid[$keys],
                'mounth' => $mounth[$keys],
            ]);
            activity()->causedBy(Auth::user())->event('Updated')->log('User operator ' . auth()->user()->name . ' melakukan Updated Tagihan untuk ' . $biaya->nama_biaya);
            $tagihanGet = Tagihan::where('id', $ids[$keys])->get();
            $tenggat = Notify::where('id', 4)->first();
            foreach ($tagihanGet as $index => $tagihs) {
                $end_date = strtotime($tenggat->notif, strtotime($dateEnd[$keys] . '-' . date('Y'))); // foreach ($valid as $index => $n) {
                $end_dates = date('d-m', $end_date);
                $tagihanDetails = TagihanDetail::where('id_tagihan', $tagihs->id);
                $tagihanDetails->update([
                    'start_date' => $dateStart[$keys],
                    'end_date' => $dateEnd[$keys],
                    'nama_biaya' => $biaya->nama_biaya,
                    'jumlah_biaya' => $valid[$keys],
                    'bulan' => $end_dates,
                ]);
            }
            $biaya->update($data);
            // dd($result);     
        }
        return redirect()->route('admin.biaya.index')->with('pesan', "Biaya Berhasil Diedit!!!");
    }
    /**
     * Remove the specified resource from storage.
     */

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $biaya = Biaya::whereIn('id', $ids);
        $tagihans = Tagihan::whereIn('id_biayas', $ids)->get();
        $tagihan = Tagihan::whereIn('id_biayas', $ids);

        foreach ($tagihans as $tagihanDelete) {
            $detail = TagihanDetail::where('id_tagihan', $tagihanDelete->id);
            $detail->delete();
        }
        $tagihan->delete();
        $biaya->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus biaya yang dipilih');
    }
    public function destroy($id)
    {
        $biaya = Biaya::findOrFail($id);
        $tagihan = Tagihan::where('id_biayas', $id);
        $getTagihan = Tagihan::where('id_biayas', $id)->get();

        foreach ($getTagihan as $tagihanUser) {
            $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihanUser->id);
            $tagihanDetail->delete();
        }
        $tagihan->delete();
        $biaya->delete();

        return redirect()->route('admin.biaya.index');
    }
}
