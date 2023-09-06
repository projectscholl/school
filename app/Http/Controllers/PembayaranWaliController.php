<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request, $id)
    {
        $biaya = Biaya::find($id);
        $IdMurid = $request->idmurid;
        $murid = Murid::find($IdMurid);
        
        if (!$request->amount) {
            return redirect()->route('wali.tagihan.pembayaran', $biaya->id . '?idmurid='.$murid->id)->with('error', 'Pilih setidaknya satu tagihan.');
        }

        foreach ($request->amount as $key => $value) {
            $tagihans[] = Tagihan::where('id', $key)->first()->amount;
        }

        return view('wali.tagihan.pilih_pembayaran', [
            'id' => $biaya->id,
            'murid' => $murid,
            'tagihans' => array_sum($tagihans),
        ]);
    }

    public function pilih_pembayaran(Request $request, string $id, string $idmurid)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $murid = Murid::find($idmurid);

        return 'lanjut';
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
