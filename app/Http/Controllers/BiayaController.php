<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
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
            'amount.*' => 'required|numeric',
            'status' => 'nullable',
        ]);

        $biaya = Biaya::create($data);

        $dateStart = request()->input('start_date');
        $dateEnd =  request()->input('end_date');
        $mounth =  request()->input('mounth');
        $amount = request()->input('amount');
        $valid = str_replace('.', '', $amount);
        // dd($dateStart);
        $muridUser = Murid::with('User')->where('id_jurusans', $biaya->id_jurusans)->where('id_angkatans', $biaya->id_angkatans)->where('id_kelas', $biaya->id_kelas)->get();

        foreach ($valid as $index => $n) {

            $Tagihan = Tagihan::create([
                'id_biayas' => $biaya->id,
                'mounth' => $mounth[$index],
                'amount' => $n,
                'start_date' => $dateStart[$index],
                'end_date' => $dateEnd[$index],
            ]);
            $murid = Murid::with('User')->where('id_angkatans', $biaya->id_angkatans)->where('id_jurusans', $biaya->id_jurusans)->where('id_kelas', $biaya->id_kelas)->get();
            foreach ($murid as $key => $murids) {
                // print_r($murids->id);
                TagihanDetail::create([
                    'id_tagihan' => $Tagihan->id,
                    'id_murids' => $murids->id,
                    'start_date' => $dateStart[$key],
                    'end_date' => $dateEnd[$key],
                    'nama_biaya' => $biaya->nama_biaya,
                    'jumlah_biaya' => $n,
                ]);
                // $users = User::where('id', $murids->id_users)->get();
                // $notify = Notify::where('id', 1)->get();
                // foreach ($users as $ray => $wali) {
                //     $messages = $notify[$ray]->notif . ' ' . $biaya->nama_biaya . ' ' . number_format($n, 2, ',', '.');
                //     $this->send_message($wali->telepon, $messages);
                //     // print_r($wali->telepon);
                //     // echo "<br>";
                // }
            }
            // foreach ($muridUser as $user) {
            // }
            // foreach ($Tagihan as $tagihanDetail) {
            //     TagihanDetail::create([
            //         'id_tagihan' => $tagihanDetail->id,
            //         'id_murids' => $tagihanDetail->id,
            //         'nama_biaya' => $tagihanDetail->biayas->nama_biaya,
            //         'status' => $tagihanDetail->status,
            //     ]);
            // }

        }



        return redirect()->route('admin.biaya.index')->with('success', "Biaya Berhasil Dibuat!!!");
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
        $tagihansDelete = Tagihan::where('id_biayas', $id);
        $tagihans = Tagihan::where('id_biayas', $id)->get();

        $murid = Murid::with('biayas')->where('id_angkatans', $biaya->id_angkatans)->where('id_jurusans', $biaya->id_jurusans)->where('id_kelas', $biaya->id_kelas)->get();


        $dateStart = request()->input('start_date');
        $dateEnd = request()->input('end_date');
        $mounth = request()->input('mounth');
        $amount = request()->input('amount');
        foreach ($tagihans as $tagihanMurid) {
            $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihanMurid->id);
            $tagihanDetail->delete();
        }
        $tagihansDelete->delete();

        // $tagihanDetail->delete();
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

                foreach ($murid as $murids) {
                    $datas = Tagihan::where('id_biayas', $id)->get();

                    $data2 = [
                        'id_tagihan' => $datas[$key]->id,
                        'id_murids' => $murids->id,
                        'start_date' => $datas[$key]->start_date,
                        'end_date' => $datas[$key]->end_date,
                        'nama_biaya' => $biaya->nama_biaya,
                        'jumlah_biaya' => $datas[$key]->amount,
                    ];
                    TagihanDetail::create($data2);
                }
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
        $getTagihan = Tagihan::where('id_biayas', $id)->get();

        foreach ($getTagihan as $tagihanUser) {
            $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihanUser->id);
            $tagihanDetail->delete();
        }
        $tagihan->delete();
        $biaya->delete();

        // return redirect()->route('admin.biaya.index');
    }
}
