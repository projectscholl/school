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
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $IdMurid = $_GET['idmurid'];
        $murid = Murid::find($IdMurid);
        $bulan = Tagihan::where('id_biayas', $tagihan->id)->get();

        if (!$request->amount) {
            return view('wali.tagihan.pembayaran', compact('instansi', 'bulan', 'tagihan', 'murid'))->with('error', 'Pilih setidaknya satu tagihan.');
        }

        // $key disini adalah index nya, jadi kita ini buat manual index dari blade tadi. amount[{{ $bulans->id }}], $bulans->id ini adalah index manual yang kita masukin kedalam array nya amount
        foreach ($request->amount as $key => $value) {
            $tagihs[] = Tagihan::where('id', $key)->first();
        }
        
        $tagihans = $tagihs;

        dd($tagihans); // coba di run rey, ss kasih ke aku di wa.
        
        return redirect()->route('wali.tagihan.pilih_pembayaran', ['id' => $request->amount]);
    }

    public function pilih_pembayaran(Request $request, string $id, string $idmurid)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $idMurid = $_GET['idmurid'];
        $murid = Murid::find($idMurid);
        return redirect()->route('wali.tagihan.pilih_pembayaran', compact('instansi', 'user', 'tagihan', 'murid'));
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
