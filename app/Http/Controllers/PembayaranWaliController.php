<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use App\Notifications\PembayaransNotifications;
use App\Traits\Ipaymu;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;


class PembayaranWaliController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    use Ipaymu;
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
            'total_bayar' => 'required',
        ]);


        
        if ($request->hasFile('bukti_transaksi')) {
            $imagePath = $request->file('bukti_transaksi')->store('public/image');
            $imageName = basename($imagePath);
            $data['bukti_transaksi'] = $imageName;
        }
        
        $idTagihanDetails = $request->input('id_tagihan_details');

        $data['id_users'] = Auth::id();
        $data['year'] = date('Y');
        $pembayarans = Pembayaran::create($data);
        $userAdmin = User::where('role', 'ADMIN')->get();
        Notification::send($userAdmin, new PembayaransNotifications($pembayarans));
        foreach ($idTagihanDetails as $idTagihanDetail) {
            $tagihanDetail = TagihanDetail::find($idTagihanDetail);
            $tagihanDetail->update(['id_pembayarans' => $pembayarans->id]);
        }
        // dd($data);

        return redirect()->route('wali.tagihan.index')->with('message', 'Pembayaran Berhasil, Silakan Tunggu Konfirmasi Dari Admin');
        // return redirect()->route('wali.tagihan.index');
    }

    public function result()
    {
    $user = Auth::user(); 
    $pembayaran = Pembayaran::where('id_users', $user->id)->get();

    return view('wali.tagihan.result', compact('pembayaran'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function bank(Request $request, $id)
    {
        $id_tagihans = $request->amount;
        $biaya = Biaya::find($id);
        $tagihs = Tagihan::where('id_biayas', $biaya->id)->get();
        $IdMurid = $request->idmurid;
        $murid = Murid::find($IdMurid);

        if (!$request->amount) {
            return redirect()->route('wali.tagihan.pembayaran', ['id' => $biaya->id, 'idmurid' => $murid->id])->with('error', 'Pilih setidaknya satu tagihan.');

        }

        foreach ($request->amount as $key => $value) {
            $tagihans[] = TagihanDetail::where('id', $key)->first()->jumlah_biaya;
            $tagihanDetails[] = TagihanDetail::where('id', $key)->first();
        }

        session(['tagihans' => array_sum($tagihans)]);
        session(['id_tagihans' => $id_tagihans]);

        return view('wali.tagihan.pilih_pembayaran', [
            'id' => $biaya->id,
            'murid' => $murid,
            'tagihans' => array_sum($tagihans),
            'tagihs' => $tagihs,
            'id_tagihans' => $id_tagihans,
            'tagihanDetails' => $tagihanDetails,
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
        $tagihans = Tagihan::where('id_biayas', $id)->get();
        $murid = Murid::find($idmurid);
        $totalTagihan = session('tagihans');
        $id_tagihans = session('id_tagihans');
        foreach ($request->tagihanDetails as $key => $value) {
            $tagihanDetails[] = TagihanDetail::where('id', $value)->first();
        }

        return view('wali.tagihan.bayar', compact('instansi', 'bank', 'tagihan', 'totalTagihan', 'id_tagihans', 'murid', 'tagihans', 'tagihanDetails'));
    }
    public function bayarCash(Request $request, $id)
    {
        $tagihan = $request->id;
        foreach ($tagihan as $idTagihan) {
            $tagihans = TagihanDetail::where('id', $idTagihan)->get();
            foreach ($tagihans as $t) {
                $jumlahBiaya[] = $t->jumlah_biaya;
            }
        }
        $total = array_sum($jumlahBiaya);
        $murid = Murid::where('id', $id)->first();
        return view('admin.murid.bayar', compact('tagihan', 'total', 'murid'));
    }

    public function bayarCashProses(Request $request, $id)
    {

        $data = $request->validate([
            'total_bayar' => 'required',
        ]);
        $total = $request->total_bayar;
        $id = $request->id;
        $auth = Auth::user();
        $murid = Murid::where('id', $id)->first();

        $pembayarans =  Pembayaran::create([
            'id_users' => $auth->id,
            'total_bayar' => $total,
            'payment_links' => 'Cash',
            'payment_status' => 'Berhasil',
            'nama_pengirim' => $auth->name,
            'year' => date('Y'),
        ]);
        foreach ($id as $keys => $id_details) {

            $tagihandetail = TagihanDetail::where('id', $id_details);
            $sudah = 'SUDAH';
            $tagihandetail->update([
                'id_pembayarans' => $pembayarans->id,
                'status' => $sudah,
            ]);
        }
        return redirect()->route('admin.murid.index')->with('berhasil', "Berhasil Membayar!!");
    }

    public function payIpaymu(Request $request, $id,  $idmurid)
    {
        $data = $request->validate([
            'total' => 'required',
            'tagihanDetails.*' => 'required',
        ]);
        $total = $request->total;
        $id_tagihan = $request->input('tagihanDetails');
        $id_tagihan = array_map('strip_tags', $id_tagihan);
        $id_tagihan = array_map('htmlspecialchars', $id_tagihan);
        // print_r($id_tagihan);
        $biaya = Biaya::find($id);
        $payment = json_decode(json_encode($this->redirect_payment($id,  $total, $id_tagihan)), true);
        // dd($payment);
        $pembayaran = Pembayaran::create([
            'id_users' => Auth::user()->id,
            'payment_status' => 'pending',
            'payment_links' => $payment['Data']['Url'],
            'total_bayar' => $total,
            'bukti_transaksi' => $payment['Data']['SessionID'],
            'year' => date('Y'),
        ]);
        foreach ($id_tagihan as $tagihandetails) {
            $idTagihan = TagihanDetail::where('id', $tagihandetails);

            $idTagihan->update([
                'id_pembayarans' => $pembayaran->id,
            ]);
        }

        return Redirect::to($pembayaran->payment_links);
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
