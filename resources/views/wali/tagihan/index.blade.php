@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    @include('layouts.sidebar')

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-navbar></x-navbar>
                <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <div class="card">
                    <h5 class="card-header mb-4">Tagihan Suherman</h5>
                    <div class="card-body">
                        <div>NAMA : Suherman</div>
                        <hr>
                        <div>JURUSAN : RPL </div>
                        <hr>
                        <div>ANGKATAN : 2021 </div>
                        <hr>
                        <div>KELAS : 12 </div>
                        <hr>
                        <div>TANGGAL TAGIHAN : 1/1/2021 </div>
                        <hr>
                        <div>TENGGAT TAGIHAN : 1/2/2021 </div>
                        <hr>
                        <div>STATUS PEMBAYARAN : Belum Bayar </div>
                        <hr>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tagihan</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>SPP ANGKATAN 2021</td>
                                    <td>Rp 200.000.00</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><strong>Total Pembayaran:</strong></td>
                                    <td><strong>Rp 200.000.00</strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <a href="#" class="btn btn-primary fs-5">Detail Pembayaran</a>
                            <a href="#" class="btn btn-primary fs-5">Detail Pembayaran NIh jek</a>
                        </div>
                    </div>

                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
