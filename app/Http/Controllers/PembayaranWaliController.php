<?php

namespace App\Http\Controllers;

use App\Models\Bank;
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
    public function index(string $id, $IdMurid)
    {
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $murid = Murid::find($IdMurid);
        $bulan = Tagihan::where('id_biayas', $tagihan->id)->get();
        return view('wali.tagihan.pembayaran', compact('instansi', 'bulan', 'tagihan', 'murid'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'nama_pengirim' => 'required|max:255',
            'rek_pengirim' => 'required|max:16|min:16',
            'bukti_transaksi' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'identitas_penerima' => 'required',
            'total_bayar' => 'required'
        ]);        

        
        $imagePath = $request->file('bukti_transaksi')->store('public/image');
        
        $imageName = basename($imagePath);
        $data['id_tagihans'] = $request->input('id_tagihans');
        $data['id_users'] = Auth::id();

        // Simpan data ke dalam database
        // dd($data);
        Pembayaran::create($data);

        return redirect()->route('wali.tagihan.index')->with('message', 'Pembayaran Berhasil, Silakan Tunggu Konfirmasi Dari Admin');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function bank(Request $request, $id)
    {
        $id_tagihans = $request->amount;
        $biaya = Biaya::find($id);
        $IdMurid = $request->idmurid;
        $murid = Murid::find($IdMurid);

        if (!$request->amount) {
            return redirect()->route('wali.tagihan.pembayaran', $biaya->id . '?idmurid=' . $murid->id)->with('error', 'Pilih setidaknya satu tagihan.');
        }

            foreach ($request->amount as $key => $value) {
                $tagihans[] = Tagihan::where('id', $key)->first()->amount;
                // dd($request->all());
                // $bill = Tagihan::where('id_biayas',$biaya->id)->get();
                // foreach($bill as $bills){
                //     $tagihan = $bills->id;
                // }
            }

        session(['tagihans' => array_sum($tagihans)]);
        session(['id_tagihans' => $id_tagihans]);

        return view('wali.tagihan.pilih_pembayaran', [
            // 'id' => $biaya->id,
            'murid' => $murid,
            'tagihans' => array_sum($tagihans),
            'id_tagihans' => $id_tagihans
        ]);
    }

    public function pilih_pembayaran(Request $request, string $id, string $idmurid)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $tagihan = Biaya::find($id);
        $murid = Murid::find($idmurid);
        dd($murid);

        return 'lanjut';
    }


    public function bayar(Request $request, string $id, $idmurid)
    {
        $instansi = Instansi::first();
        $bank = Bank::all();
        $tagihan = Biaya::find($id);
        $tagihan = Tagihan::find($id);
        $murid = Murid::find($idmurid);
        $totalTagihan = session('tagihans');
        $id_tagihans = session('id_tagihans');
        // dd($tagihan);


        return view('wali.tagihan.bayar', compact('instansi', 'bank', 'tagihan', 'totalTagihan', 'id_tagihans'));
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
