@extends('layouts.master')

@section('title, Pembayaran')
@section('content')
    @include('layouts.sidebar')

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
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-white">Murid Information</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Nama Murid : <strong>Jono</strong></td>
                                </tr>
                                <tr>
                                    <td>Nama Wali Murid : <strong>Lisa blackwhite</strong></td>
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
                                    <td>Nomor Tagihan : <strong>#09092</strong></td>
                                </tr>
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
                                <tr>
                                    <td>Metode Pembayaran : <strong>Online</strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembayaran : <strong class="">25/05/2050</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan : <strong class="">500.000</strong></td>
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
                                <tr>
                                    <td>Status Pembayaran : <strong class="">Bayar</strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Konfirmasi : <strong class="">25/05/2050</strong></td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary my-4">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection
