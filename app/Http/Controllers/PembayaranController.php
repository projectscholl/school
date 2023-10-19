<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{

    use Fonnte;

    public function index(Request $request)
    {
        $user = Auth::user();
        $instansi = Instansi::first();

        $paymentStatus = $request->input('payment_status');

        $pembayarans = Pembayaran::when($paymentStatus, function ($query, $paymentStatus) {
            if ($paymentStatus === 'Cash') {
                return $query->where('payment_links', 'Cash');
            } elseif ($paymentStatus === 'Bank') {
                return $query->where('payment_links', null);
            } elseif ($paymentStatus === 'Pembayaran Online') {
                return $query->where('payment_links', '<>', 'Cash')->whereNotNull('payment_links');
            } else {
                return $query;
            }
        })->orderBy('created_at', 'desc')->get();


        $idsMurids = $pembayarans->pluck('id_murids')->unique();


        return view('admin.pembayaran.index', compact('user', 'instansi', 'pembayarans', 'idsMurids'));
    }



    public function show(string $id)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $pembayaran = Pembayaran::find($id);
        $html = "<img src='" . public_path("storage/image/{$instansi->logo}") . "' alt='' class='mb-4' width='100'>";
        return view('admin.pembayaran.detail', compact('user', 'instansi', 'pembayaran', 'html'));
    }


    public function confirm(Request $request, string $id)
    {
        $pembayaran = Pembayaran::with('tagihanDetails')->find($id);

        if (!$pembayaran) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        foreach ($pembayaran->tagihanDetails as $tagihanDetail) {
            $tagihanDetail->update(['status' => 'SUDAH']);
        }

        $pembayaran->update(['payment_status' => 'berhasil']);

        $user = User::where('id', $pembayaran->id_users)->first();
        $send = 'Assalamualaikum warahmatullahi wabarakatu yang terhormat Bapak / Ibu, kami Informasikan Bahwa Pembayaran Bapak / Ibu sudah berhasil di Konfirmasi Oleh admin';

        // dd($user->telepon);
        $this->send_message($user->telepon, $send);

        return redirect()->route('admin.pembayaran.index')->with('pesan', 'Pembayaran Berhasil Di Konfirmasi');
    }

    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;
        $pemabayaran = Pembayaran::whereIn('id', $ids);
        $pemabayaran->delete();
        return redirect()->route('admin.pembayaran.index')->with('pesan', 'Pembayaran Berhasil dihapus');
    }
}
