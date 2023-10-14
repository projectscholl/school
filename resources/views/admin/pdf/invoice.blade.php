<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice</title>
    <style>
        @font-face {
            font-family: 'Public Sans';
            src: url('/fonts/PublicSans-Regular.ttf');
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Public Sans', sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: 'Public Sans', sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('storage/image/' . $instansi->logo) }}" alt='' class='mb-4'
                                    width='100'><br>
                                <strong class="fs-1">{{ $instansi->name }}</strong><br />
                                {{ $instansi->alamat }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Informasi Pembayaran</td>
                <td></td>
            </tr>

            {{-- <tr class="item">
            <td>Invoice #: {{ $pembayaran->id }}</td>
        </tr> --}}
            <tr class="item">
                <td>Tanggal Pembayaran: <strong>{{ $pembayaran->created_at->format('d F Y') }}</strong></td>
            </tr>
            <tr class="item">
                <td>Tagihan Untuk : <strong>
                        @if ($pembayaran->tagihanDetails->isNotEmpty())
                            {{ $pembayaran->tagihanDetails->first()->murids->name }}
                            ({{ $pembayaran->tagihanDetails->first()->murids->nisn }})
                    </strong>
                    @endif
                <td></td>
            </tr>
            <tr class="item">
                <td>Angkatan : <strong>
                        @if ($pembayaran->tagihanDetails->isNotEmpty())
                            {{ $pembayaran->tagihanDetails->first()->murids->angkatans->tahun }}
                    </strong>
                    @endif
                <td></td>
            </tr>
            <tr class="item">
                <td>Jurusan : <strong>
                        @if ($pembayaran->tagihanDetails->isNotEmpty())
                            {{ $pembayaran->tagihanDetails->first()->murids->jurusans->nama }}
                    </strong>
                    @endif
                <td></td>
            </tr>
            <tr class="item">
                <td>Kelas : <strong>
                        @if ($pembayaran->tagihanDetails->isNotEmpty())
                            {{ $pembayaran->tagihanDetails->first()->murids->kelas->kelas }}
                    </strong>
                    @endif
                <td></td>
            </tr>
            <tr class="item">
                <td>Nama Tagihan : <strong>
                        @if ($pembayaran->tagihanDetails->isNotEmpty())
                            {{ $pembayaran->tagihanDetails->first()->nama_biaya }}
                    </strong>
                    @endif
                <td></td>
            </tr>

            <tr class="heading">
                <td>Item Tagihan</td>

                <td>Price</td>
            </tr>

            <tr class="item">
            @foreach ($pembayaran->tagihanDetails as $pembayarans)
                <tr>
                    <td><strong>
                        @if ($pembayarans)
                            @if (!empty($pembayarans->tagihan->mounth))
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pembayarans->tagihan->mounth)->format('F') }}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </strong></td>                    
                    <td>Rp {{ number_format($pembayarans->tagihan->amount) }}</td>
                </tr>
            @endforeach
            </tr>

            <tr class="total">
                <td></td>

                <td>Total: Rp {{ number_format($pembayaran->total_bayar) }}</td>
            </tr>

        </table>
        <hr>
        <form action="{{ route('admin.laporan.invoice', $pembayaran->id) }}" method="GET">
            <button type="submit" id="unduh-button">
                <strong>
                    Unduh
                </strong>
            </button>
        </form>
    </div>
</body>

</html>
