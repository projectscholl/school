<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Murid;
use App\Models\TagihanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;


class PdfController extends Controller
{
    public function tagihan()
    {
        $instansi = Instansi::first();
    }
    public function pembayaran()
    {
        $instansi = Instansi::first();
        return view('admin.pdf.pembayaran-pdf', compact('instansi'));
    }


    public function spp($id_murids)
    {
        $instansi = Instansi::first();
        $murid = Murid::find($id_murids);
        if (!$murid) {
            return redirect()->back()->with('error', 'Murid tidak ditemukan.');
        }

        // Ambil biaya rutin untuk murid ini
        $biayaRutin = $murid->biayas()->where('jenis_biaya', 'routine')->first();

        if ($biayaRutin) {
            $tagihanSPPs = $murid->tagihanDetail()
                ->whereHas('tagihan', function ($query) use ($biayaRutin) {
                    $query->whereHas('biayas', function ($query2) {
                        $query2->where('jenis_biaya', 'routine');
                    });
                })
                ->get();
            $html = "<img src='" . public_path("/storage/image/{$instansi->logo}") . "' alt='' class='mb-4' width='100'>";
            $tanda_tangan = "<img src='" . public_path("storage/image/{$instansi->logo}") . "' alt='' class='mb-4' width='100'>";
            return view('admin.pdf.spp-pdf', compact('murid', 'tagihanSPPs', 'instansi', 'html', 'tanda_tangan'));
        } else {
            return redirect()->back()->with('error', 'Murid tidak memiliki biaya rutin.');
        }
    }

    public function downloadPdf(Request $request, $id_murids)
    {
        $instansi = Instansi::first();
        $murid = Murid::findOrFail($id_murids);
        if (!$murid) {
            return redirect()->back()->with('error', 'Murid tidak ditemukan.');
        }

        $biayaRutin = $murid->biayas()->where('jenis_biaya', 'routine')->first();

        if ($biayaRutin) {
            // Buat instance Dompdf dengan opsi
            $tagihanSPPs = $murid->tagihanDetail()
                ->whereHas('tagihan', function ($query) use ($biayaRutin) {
                    $query->whereHas('biayas', function ($query2) {
                        $query2->where('jenis_biaya', 'routine');
                    });
                })
                ->get();
            
                $html = "<img src='" . public_path("storage/image/{$instansi->logo}") . "' alt='' class='mb-4' width='100'>
                <h1 style='font-weight: bold; font-size: 48px; margin: 0;'>{$instansi->name}</h1>
                <span>{$instansi->alamat}</span>
                <div class='invoiceDetails'>
                    <h2 style='font-size: 24px;'>Kartu SPP</h2>
                    <p>Nama Siswa : <strong>{$murid->name}</strong>.</p>
                    <p>Kelas : <strong>{$murid->kelas->kelas}</strong>.</p>
                    <p>Jurusan : <strong>{$murid->jurusans->nama}</strong>.</p>
                    <p>NISN : <strong>{$murid->nisn}</strong></p>
                </div>
                <main>
                    <table style='width: 100%; border-collapse: collapse;'>
                        <thead>
                            <tr style='background-color: #f2f2f2; text-align: left;'>
                                <th style='padding: 8px; border: 1px solid #ddd;'>No</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>Bulan</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>JUMLAH TAGIHAN</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>TANGGAL BAYAR</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>PARAF</th>
                            </tr>
                        </thead>
                        <tbody>";
        
        $no = 1;
        foreach ($tagihanSPPs as $tagihanDetail) {
            $html .= "<tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$no}</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$tagihanDetail->tagihan->mounth}</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>Rp " . number_format($tagihanDetail->tagihan->amount) . "</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>";
        
            if ($tagihanDetail->pembayaran) {
                $html .= $tagihanDetail->pembayaran->created_at->format('d/m/Y');
            } else {
                $html .= "Belum Bayar";
            }
        
            $html .= "</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>";
        
            if ($tagihanDetail->pembayaran) {
                // Tambahkan gambar tanda tangan jika diperlukan
                $html .= "<img src='" . public_path("storage/image/{$instansi->tanda_tangan}") . "' alt='' class='mb-4' width='100'>";
            } else {
                $html .= "-";
            }
        
            $html .= "</td>
                </tr>";
        
            $no++;
        }
        
        $html .= "</tbody>
                </table>
            </main>";        

            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);

            $pdf = PDF::loadView('admin.pdf.spp-pdf', compact('murid', 'tagihanSPPs', 'instansi', 'html'));
            $pdf->loadHtml($html)->setPaper('A4', 'portrait');
            return $pdf->download('Kartu SPP.pdf');
        }
    }
}
