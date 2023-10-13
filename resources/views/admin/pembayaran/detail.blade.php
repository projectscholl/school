@extends('layouts.master')

@section('title', 'Pembayaran')
@section('content')

    <!-- Layout container -->
    <div class="layout-page overflow-auto">
        <!-- Navbar -->
        <x-navbar>

        </x-navbar>

        <!-- / Navbar -->

        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card px-3">
                    <h5 class="card-header">Detail Pembayaran</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            {{-- <thead class="table-dark">
                                <tr>
                                    <th class="text-white">Murid Information</th>
                                </tr>
                            </thead> --}}
                            {{-- <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Nama Murid : <strong>Jono</strong></td>
                                </tr>
                                <tr>
                                    <td>Nama Wali Murid : <strong>{{ $pembayaran-> }}</strong></td>
                                </tr>
                            </tbody> --}}
                        </table>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-white">Tagihan Information</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Nomor Tagihan : <strong>#{{ $pembayaran->id }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Nama Tagihan : <strong>
                                            @if ($pembayaran->tagihanDetails->isNotEmpty())
                                                {{ $pembayaran->tagihanDetails->first()->nama_biaya }}
                                            @endif
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td>Nama Murid : <strong>
                                            @if ($pembayaran->tagihanDetails->isNotEmpty())
                                                {{ $pembayaran->tagihanDetails->first()->murids->name }}
                                        </strong>
                                        @endif
                                </tr>
                                <tr>
                                    <td class="d-flex align-items-center">Invoice Tagihan :
                                        @if ($pembayaran->payment_status  == 'PENDING')
                                            <form action="{{ route('admin.laporan.invoice_preview', $pembayaran->id) }}">
                                                <button type="submit"class="btn btn-link " disabled>
                                                    <strong>
                                                        <i class="menu-icon tf-icons bx bx-copy ms-2 "></i>Preview  
                                                    </strong>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.laporan.invoice_preview', $pembayaran->id) }}">
                                                <button type="submit"class="btn btn-link " >
                                                    <strong>
                                                        <i class="menu-icon tf-icons bx bx-copy ms-2 "></i>Preview  
                                                    </strong>
                                                </button>
                                            </form>
                                        @endif
                                        {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.pdf.invoice')
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                            <form action="{{ route('admin.laporan.invoice', $pembayaran->id) }}">
                                                                <button type="submit"class="btn btn-link btn-primary">
                                                                    <strong>
                                                                        <i class="menu-icon tf-icons bx bx-download ms-2 "></i>Unduh
                                                                    </strong>
                                                                </button>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan : <strong class="">Rp
                                            {{ number_format($pembayaran->total_bayar) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-white">Pembayaran Information</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Metode Pembayaran : <strong>
                                            @if ($pembayaran->payment_links == 'Cash')
                                                Cash
                                            @elseif($pembayaran->payment_links == null)
                                                Bank
                                            @else
                                                iPaymu
                                            @endif
                                    </td></strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembayaran : <strong
                                            class="">{{ $pembayaran->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan : <strong class="">Rp
                                            {{ number_format($pembayaran->total_bayar) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pembayaran : <strong class="">Rp
                                            {{ number_format($pembayaran->total_bayar) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="mb-3">Tagihan Yang Dibayar :
                                        <table class="table table-bordered mt-2">
                                            <thead>
                                                <tr>
                                                    <th>Tagihan</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pembayaran->tagihanDetails as $pembayarans)
                                                    <tr>
                                                        <td><strong>{{ $pembayarans->tagihan->mounth }}</strong></td>
                                                        <td>Rp {{ number_format($pembayarans->tagihan->amount) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Bukti Pembayaran :
                                        <a href="{{ asset('storage/image/' . $pembayaran->bukti_transaksi) }}"
                                            target="_blank">
                                            <br>
                                            <br>

                                            <img src="{{ asset('storage/image/' . $pembayaran->bukti_transaksi) }}"
                                                alt="Bukti Transaksi" width="150">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('admin.pembayaran.detail.confirm', $pembayaran->id) }}" method="POST">
                            @csrf
                            @if ($pembayaran->payment_status == 'PENDING')
                                <button id="confirmButton" class="btn btn-primary my-4 w-100">Confirm</button>
                            @else
                                <button id="confirmButton" class="btn btn-primary my-4 w-100" disabled>Tagihan Sudah
                                    Lunas</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            var confirmButton = document.getElementById('confirmButton');


            confirmButton.addEventListener('click', function() {
                confirmButton.style.display = 'none';
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"
            integrity="sha512-mJQ9oQHzLM2zXe1cwiHmnMddNrmjv1YlaKZe1rM4J7q8JTnNn9UgeJVBV9jyV/lVGdXymVx6odhgwNZjQD8AqA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.slim.js"
            integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                    title: 'Unduh?',
                    text: "Kamu Akan Mengunduh Invoice!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya,  Unduh!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Terunduh!',
                            'Kamu telah Mengunduh Invoice!!.',
                            'success'
                        )
                    }
                });
            });
        </script>
    @endsection
