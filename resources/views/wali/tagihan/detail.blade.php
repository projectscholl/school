@extends('layouts.master')

@section('title', 'Tagihan')
@section('content')

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
                        <div>JURUSAN : Teknik Komputer </div>
                        <hr>
                        <div>ANGKATAN : 2022 </div>
                        <hr>
                        <div>KELAS : 12 </div>
                        <hr>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 order-2 mt-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class=" m-0 me-2">Spp Angkatan 2022</h5>

                            <div class="dropdown">
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">Bulan</th>
                                        <th class="text-white">Total</th>
                                        <th class="text-white d-flex">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juni</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>July</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Oktober</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Desember</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Januari</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>February</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maret</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mei</td>
                                        <td>200.000</td>
                                        <td>
                                            <div class="text-danger"><strong>Belum</strong></div>
                                        </td>
                                    </tr>
                                    {{-- <a href="{{ route('spp') }}" class="btn btn-primary"><strong>
                                        <i class="menu-icon tf-icons bx bx-copy"></i>Cetak Kartu spp
                                    </strong></a> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('wali.tagihan.pembayaran', 2) }}" class="btn btn-primary mt-3 w-25">Detail Bayar</a>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
