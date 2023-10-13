<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<style>
    @font-face{
        font-family: 'Public Sans', sans-serif;
    }
    body{
        font-family: 'Public Sans', sans-serif;
    }
</style>
<body>
    <!-- The header element will appear on the top of each page of this invoice document. -->
    <header>

        <div class="headerSection">
            <!-- As a logo we take an SVG element and add the name in an standard H1 element behind it. -->
            <div class="container-fluid">
                <div class="logoAndName">
                    <div class="w-100 d-flex flex-column ms-2">
                        <img src="{{ asset('storage/image/' . $instansi->logo) }}" alt='' class='mt-3' width='100'>
                        <h1 style="font-weight: bold; font-size: 48px; margin: 0;">{{ $instansi->name }}</h1>
                        <span>{{ $instansi->alamat }}</span>
                        <div class='invoiceDetails'>
                            <h2 style='font-size: 24px; padding-top: 50px;'><strong>Kartu SPP</strong></h2>
                            <p>Nama Siswa : <strong>{{ $murid->name ?? 'Tidak Ada Nama' }}</strong>.</p>
                            <p>Kelas : <strong>{{ $murid->kelas->kelas ?? 'Tidak Ada Data Kelas' }}</strong>.</p>
                            <p>Jurusan : <strong>{{ $murid->jurusans->nama ?? 'Tidak Ada Data Jurusan' }}</strong>.</p>
                            <p>NISN : <strong>({{ $murid->nisn }})</strong></p>
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
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($tagihanSPPs as $tagihanDetail)
                                        <tr>
                                            <td style='padding: 8px; border: 1px solid #ddd;'>{{ $loop->iteration }}</td>
                                            <td style='padding: 8px; border: 1px solid #ddd;'>{{ $tagihanDetail->tagihan->mounth }}</td>
                                            <td style='padding: 8px; border: 1px solid #ddd;'>Rp {{ number_format($tagihanDetail->tagihan->amount) }}</td>
                                            <td style='padding: 8px; border: 1px solid #ddd;'>
                                                @if ($tagihanDetail->pembayaran)
                                                    {{ $tagihanDetail->pembayaran->created_at->format('d/m/Y') }}
                                                @else
                                                    Belum Bayar
                                                @endif
                                            </td>
                                            <td style='padding: 8px; border: 1px solid #ddd;'>@if ($tagihanDetail->pembayaran)
                                                <img src="{{ asset('storage/image/' . $instansi->tanda_tangan) }}" alt="" class="mb-4" width="100">
                                            @else
                                                -
                                            @endif</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </main> 
                    </div>
            </div>
            </div>
            
            
            <!-- Details about the invoice are on the right top side of each page. -->

        </div>

        <!-- The two header rows are divided by a blue line. -->
    </header>
    <hr>
    <form action="{{ route('admin.pdf.downloadPdf', ['id_murids' => $murid->id]) }}" method="GET">
        <button type="submit" id="unduh-button" class="btn btn-primary mb-3 ms-3">
            <strong>
                Unduh
            </strong>
        </button>
    </form>

    <!-- Within the aside tag we will put the terms and conditions which shall be shown below the invoice table. -->

</body>

</html>
