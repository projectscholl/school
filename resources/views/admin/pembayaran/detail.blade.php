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
                                    <td class="d-flex align-items-center">Invoice Tagihan : <button type="submit"
                                            class="btn btn-link">
                                            <strong>
                                                <i class="menu-icon tf-icons bx bx-copy ms-2"></i>Cetak
                                            </strong>
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan : <strong class="">Rp {{ number_format($pembayaran->total_bayar)}}</strong></td>
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
                                    <td>Metode Pembayaran : <strong>@if ($pembayaran->payment_links)
                                        iPaymu
                                    @else
                                        Bank
                                    @endif</td></strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembayaran : <strong class="">{{ $pembayaran->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan : <strong class="">Rp {{ number_format($pembayaran->total_bayar)}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pembayaran : <strong class="">Rp {{ number_format($pembayaran->total_bayar)}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Bukti Pembayaran : <img src="{{ asset('storage/image/' . $pembayaran->bukti_transaksi) }}" alt="Bukti Transaksi" width="100"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        <form action="{{ route('admin.pembayaran.detail.confirm', $pembayaran->id) }}" method="POST">
                            @csrf
                            @if ($pembayaran->payment_status == 'Belum Di Konfirmasi')
                                <button id="confirmButton" class="btn btn-primary my-4 w-100">Confirm</button>
                            @else
                                <button id="confirmButton" class="btn btn-primary my-4 w-100" disabled>Tagihan Sudah Lunas</button>
                            @endif
                        </form>                                           
                    </div>
                </div>
            </div>
        </div>


        <script>
            
            var confirmButton = document.getElementById('confirmButton');
        
            
            confirmButton.addEventListener('click', function () {
            confirmButton.style.display = 'none';
            });
        </script>        
    @endsection
