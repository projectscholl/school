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
use Dompdf\Dompdf;
use Dompdf\Options;
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

    public function invoice_preview(string $id)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $pembayaran = Pembayaran::find($id);
        $data = [
            'instansi' => $instansi,
            'pembayaran' => $pembayaran,
        ];
        return view('admin.pdf.invoice', compact('user',  'instansi',  'pembayaran'));
    }

    public function invoice(string $id)
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        $pembayaran = Pembayaran::find($id);

        $html = "<table style='max-width: 1100px; margin: auto; padding: 30px; border: 1px solid #eee;'>
        <tr class='information'>
            <td colspan='2'>
                <table style='width: 100%; border-collapse: collapse;'>
                    <tr>
                        <td>
                            <img src='" . public_path('storage/image/' . $instansi->logo) . "' alt='' style='margin-bottom: 4px; width: 100px;'><br>
                            <strong style='font-size: 24px; font-weight: bold; margin: 0;'>" . $instansi->name . "</strong><br/>
                            <span>" . $instansi->alamat . "</span><br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

            <tr>
            <td style='font-size: 20px; padding-top: 20px;'><strong>Informasi Pembayaran<strong></td>
            </tr>
            <tr>
                <td style='border-top: 1px solid #eee;'></td>
            </tr>
            <hr style='width: 120%;'>

            <tr class='item'>
                <td>Tanggal Pembayaran: <strong>" . $pembayaran->created_at->format('d F Y') . "</strong></td>
            </tr>
            <tr class='item'>
                <td>Tagihan Untuk  : <strong>";
                if ($pembayaran->tagihanDetails->isNotEmpty()) {
                    $html .= $pembayaran->tagihanDetails->first()->murids->name . " (" . $pembayaran->tagihanDetails->first()->murids->nisn . ")";
                }
                $html .= "</strong>
                <td></td>
            </tr>
            <tr class='item'>
                <td>Angkatan  : <strong>";
                if ($pembayaran->tagihanDetails->isNotEmpty()) {
                    $html .= $pembayaran->tagihanDetails->first()->murids->angkatans->tahun;
                }
                $html .= "</strong>
                <td></td>
            </tr>
            <tr class='item'>
                <td>Jurusan  : <strong>";
                if ($pembayaran->tagihanDetails->isNotEmpty()) {
                    $html .= $pembayaran->tagihanDetails->first()->murids->jurusans->nama;
                }
                $html .= "</strong>
                <td></td>
            </tr>
            <tr class='item'>
                <td>Kelas  : <strong>";
                if ($pembayaran->tagihanDetails->isNotEmpty()) {
                    $html .= $pembayaran->tagihanDetails->first()->murids->kelas->kelas;
                }
                $html .= "</strong>
                <td></td>
            </tr>
            <tr class='item'>
                <td>Nama Tagihan : <strong>";
                if ($pembayaran->tagihanDetails->isNotEmpty()) {
                    $html .= $pembayaran->tagihanDetails->first()->nama_biaya;
                }
                $html .= "</strong>
                <td></td>
            </tr>
            

            <tr class='heading'>
                <td style='font-size: 20px; padding-top: 20px;'><strong>Item Tagihan</strong></td>
                <td style='font-size: 20px; padding-top: 20px;'><strong>Harga</strong></td>
            </tr>
            <hr style='width: 120%;'>";
            

                foreach ($pembayaran->tagihanDetails as $pembayarans) {
                    $namaBulan = Carbon::parse($pembayarans->tagihan->mounth)->format('F');

                    $html .= "<tr class='item'>
                        <td style='padding: 10px;'><strong>" . $namaBulan . "</strong></td>
                        <td>Rp " . number_format($pembayarans->tagihan->amount) . "</td>
                    </tr>";
                }

                $html .= " <tr class='total'>
                <td style='padding-top: 15px; text-align: center;'><strong>Total: Rp " . number_format($pembayaran->total_bayar) . "</strong></td>
            </tr>
        </table>";




        $data = [
            'instansi' => $instansi,
            'pembayaran' => $pembayaran,
            'html' => $html,
        ];
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $pdf = PDF::loadView('admin.pdf.invoice', $data);
        $namaBiaya = $data['pembayaran']->tagihanDetails->first()->nama_biaya;
        $namaFile = 'invoice_pembayaran_' . str_replace(' ', '_', $namaBiaya)  .  str_replace('  ', '_',  $pembayaran->tagihanDetails->first()->murids->name).  '.pdf';
        $pdf->loadHtml($html)->setPaper('A4', 'portrait');
        return $pdf->download($namaFile);
    }

    public function Pdf()
    {
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
