<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
        $angkatans = $request->id_angkatans;
        $jurusans = $request->id_jurusans;
        $kelas = $request->id_kelas;
        $tahun = Angkatan::where('id', $angkatans)->get();
        $datas = Murid::with('biayas')->where('id_angkatans', $angkatans)->where('id_jurusans', $jurusans)->where('id_kelas', $kelas)->get();
        foreach ($datas as $murid) {
            $biaya = Biaya::with('tagihans')->where('id_angkatans', $murid->id_angkatans)->where('id_jurusans', $murid->id_jurusans)->where('id_kelas', $murid->id_kelas)->get();

            // foreach ($biaya as $biayas) {
            //     print_r($biayas->nama_biaya);
            //     foreach ($biayas->tagihans as $tagih) {
            //         $tagihans = Tagihan::where('id_biayas', $biayas->id)->get();
            //     }
            // }
        }
        // $pdf = PDF::loadView('admin.pdf.tagihan-pdf', compact('datas', 'biaya', 'tahun'));

        // return $pdf->download('admin.pdf.tagihan-pdf');
        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML(view('admin.pdf.tagihan-pdf', ['datas' => $datas, 'biaya' => $biaya, 'tahun' => $tahun]));
        // $mpdf->Output();
        // $pdf = PDF::loadView('admin.pdf.tagihan-pdf', compact('datas', 'biaya', 'tahun'));
        // $pdf->setPaper('A4', 'potrait');
        // return $pdf->stream('tagihan.pdf');
        return view('admin.pdf.tagihan-pdf', compact('datas', 'biaya', 'tahun'));
    }
}
