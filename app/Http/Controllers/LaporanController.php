<?php

namespace App\Http\Controllers;

use App\Exports\MuridExport;
use App\Exports\PembayaranExport;
use App\Exports\TagihanExport;
use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $instansi = Instansi::first();
        $angkatan = Angkatan::all();
        $jurusanGrouped = Jurusan::with('angkatans')->get()->groupBy('id_angkatans');
        $kelasGrouped = Kelas::with('jurusans')->get()->groupBy('id_jurusans');
        return view('admin.laporan.index', compact('instansi', 'angkatan', 'jurusanGrouped', 'kelasGrouped'));
    }
    public function Pdf(Request $request)
    {
        // $data = $request->validate([
        //     'id_angkatans' => 'required',
        //     'id_jurusans' => 'required',
        //     'id_kelas' => 'required',
        // ]);
        // $angkatans = $request->id_angkatans;
        // $jurusans = $request->id_jurusans;
        // $kelas = $request->id_kelas;
        // $tahun = Angkatan::where('id', $angkatans)->get();
        // $datas = Murid::with('biayas')->where('id_angkatans', $angkatans)->where('id_jurusans', $jurusans)->where('id_kelas', $kelas)->get();
        // $biaya = Biaya::with('tagihans')->where('id_angkatans', $angkatans)->where('id_jurusans', $jurusans)->where('id_kelas', $kelas)->get();
        // // $pdf = PDF::loadView('admin.pdf.tagihan-pdf', compact('datas', 'biaya', 'tahun'));

        // return $pdf->download('admin.pdf.tagihan-pdf');
        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML(view('admin.pdf.tagihan-pdf', ['datas' => $datas, 'biaya' => $biaya, 'tahun' => $tahun]));
        // $mpdf->Output();
        // $pdf = PDF::loadView('admin.pdf.tagihan-pdf', compact('datas', 'biaya', 'tahun'));
        // $pdf->setPaper('A4', 'potrait');
        // return $pdf->stream('tagihan.pdf');
        return view('admin.pdf.tagihan-pdf', compact('biaya', 'datas',  'tahun'));
    }

    public function export(Request $request)
    {
        $data = $request->validate([
            'id_angkatans' => 'required',
            'id_jurusans' => 'required',
            'id_kelas' => 'required',
        ]);

        $excel = [];
        $angkatans = $request->id_angkatans;
        $jurusans = $request->id_jurusans;
        $kelas = $request->id_kelas;
        // $tahun = Angkatan::where('id', $angkatans)->get();
        // $datas = Murid::with('biayas')->where('id_angkatans', $angkatans)->where('id_jurusans', $jurusans)->where('id_kelas', $kelas)->get();
        $biaya = Biaya::with('tagihans')->where('id_angkatans', $angkatans)->where('id_jurusans', $jurusans)->where('id_kelas', $kelas)->get();
        $Notbiaya = Biaya::with('tagihans')->where('id_angkatans', $angkatans)->where('id_jurusans', $jurusans)->where('id_kelas', $kelas)->first();
        // $biaya = Biaya::whereHas('tagihans', function ($query) {
        //     $query->where()
        // })->get();
        if (!empty($Notbiaya)) {
            foreach ($biaya as $biayas) {
                foreach ($biayas->tagihans as $tagihan) {
                    $tagihanDetail = TagihanDetail::where('id_tagihan', $tagihan->id)->get();
                    foreach ($tagihanDetail as $tagihanDetails) {
                        $myDate = $tagihan->start_date . '-' . date('Y');
                        $date = Carbon::parse($myDate);
                        $datay = $date->format('F');
                        $excel[] = [
                            'NAMA TAGIHAN' => $biayas->nama_biaya,
                            'NAMA MURID' => $tagihanDetails->murids->name,
                            'ANGKATAN' => $tagihanDetails->murids->angkatans->tahun,
                            'BULAN TAGIHAN' => $datay,
                            'STATUS' => $tagihanDetails->status,
                            'TOTAL' => number_format($tagihanDetails->jumlah_biaya, 2, ',', '.'),

                        ];
                        // print_r($tagihanDetails->murids->angkatans->tahun,);
                        // echo ''
                    }
                }
            }
            activity()->causedBy(Auth::user())->event('Export Excel Tagihan')->log('User operator ' . auth()->user()->name . ' melakukan Export Excel Tagihan');
            return Excel::download(new TagihanExport($excel), 'tagihan.xlsx');
        } else {
            return redirect()->back()->with('error', 'Belum ada tagihan siswa');
        }
    }

    public function export2(Request $request)
    {


        $data = [];
        $status = $request->status;

        if ($status == 'berhasil' || $status == 'pending' || $status == 'expired') {
            $pembayaran = Pembayaran::where('payment_status', $status)->get();

            foreach ($pembayaran as $keys => $pembayarans) {
                $data[] = [
                    $keys + 1,
                    $pembayarans->nama_pengirim,
                    $pembayarans->payment_status,
                    $pembayarans->total_bayar,
                    $pembayarans->payment_links,
                ];
            }
            activity()->causedBy(Auth::user())->event('Export Excel Pembayaran')->log('User operator ' . auth()->user()->name . ' melakukan Export Excel Pembayaran' . $status);
            return Excel::download(new PembayaranExport($data), 'tagihan.xlsx');
        } elseif ($status == 'all') {
            $pembayarans = Pembayaran::all();
            foreach ($pembayarans as $keys => $pembayaranss) {
                $data[] = [
                    $keys + 1,
                    $pembayaranss->nama_pengirim,
                    $pembayaranss->payment_status,
                    $pembayaranss->total_bayar,
                    $pembayaranss->payment_links,
                ];
            }
            activity()->causedBy(Auth::user())->event('Export Excel Pembayaran')->log('User operator ' . auth()->user()->name . ' melakukan Export Excel Pembayaran SEMUA');
            return Excel::download(new PembayaranExport($data), 'tagihan.xlsx');
        } else {
            return redirect()->back()->with('error', 'Gagal, Harus Pilih jenis laporan!');
        }
    }
}
