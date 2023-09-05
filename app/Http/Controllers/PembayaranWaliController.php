<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PembayaranWaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $IdMurid = $_GET['idmurid'];
        $murid = Murid::find($IdMurid);
        $bulan = Tagihan::where('id_biayas', $tagihan->id)->get();
        return view('wali.tagihan.pembayaran', compact('instansi', 'bulan', 'tagihan', 'murid'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'amount' => 'required',
        ]);

        $idBiaya = Tagihan::where('id_biayas', 'id');
        $idTagihans = Tagihan::where('id');

        
        foreach ($idTagihans as $idTagihan) {
            Pembayaran::create([
                'id_biayas' => $idBiaya->id,
                'id_tagihans' => $idTagihan,
                'amount' => $validatedData['amount'],
                'id_users' => $request->input('id_users'),
            ]);
        }

        print_r($validatedData['amount']);
        return redirect()->route('wali.tagihan.pilih_pembayaran',  $idBiaya->id);
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
        //
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
}
