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
        return view('admin.tagihan.create', compact('user', 'biaya'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_angkatans' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $user = Auth::user()->id;

        $siswa = Murid::with('angkatan')->get();

        foreach ($siswa as $itemSiswa) {
            $tanggalTagihan = Carbon::parse($request->start_date);
            $bulanTagihan = $tanggalTagihan->format('m');
            $tahunTagihan = $tanggalTagihan->format('Y');
            $tagihan = Tagihan::create([
                'id_angkatans' => $request->id_angkatans,
                'id_user' => $user,
                'start_date', $tanggalTagihan,
                'end_date' => $request->end_date,
            ]);
            // $tagihanDetail = TagihanDetail::create([
            //     'id_tagihan' => ,
            // ]);
        }




        dd($tagihan);
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
