@extends('layouts.master')

@section('title, detail')
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
                <div class="card">
                    <h5 class="card-header">Detail Pembayaran</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-white">Murid Information</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>Nama Murid : <strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Wali Murid : <strong>-></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Angkatan : <strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan : <strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas : <strong></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-white">Tagihan Information</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="d-flex align-items-center">Invoice Tagihan : <button type="submit" class="btn btn-link">
                                            <strong>
                                                <i class="menu-icon tf-icons bx bx-copy ms-2"></i>Cetak
                                            </strong>
                                        </button></td>
                                    </tr>
                                    <tr>
                                        <td>Total Tagihan : <strong class="">500.000</strong></td>
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
                                    @foreach ($pembayaran as $pembayar)
                                    <tr>
                                        <td>Metode Pembayaran : <strong>@if ($pembayar->payment_links)
                                            iPaymu
                                        @else
                                            Bank
                                        @endif</td></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembayaran : <strong class="">{{ $pembayar->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Tagihan : <strong class="">Rp {{ number_format($pembayar->total_bayar)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Pembayaran : <strong class="">1000.000</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Pembayaran : <strong class="">-</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Status Konfirmasi : <strong class="">Pending</strong></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection