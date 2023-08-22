@extends('layouts.master')

@section('title', 'Tagihan')
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
                        <div>JURUSAN : Teknik Komputer </div>
                        <hr>
                        <div>ANGKATAN : 2022 </div>
                        <hr>
                        <div>KELAS : 12 </div>
                        <hr>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 order-2 mt-4">
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
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Juni</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">July</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Agustus</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">September</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Oktober</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">November</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Desember</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Januari</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Februari</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Maret</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">April</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1 align-items-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Mei</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Rp.200.000</h6>
                                        </div>
                                        <div class="user-progress gap-1">
                                            <a href="" class="text-danger">Belum</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a href="{{ route('spp') }}" class="btn btn-primary"><strong>
                                    <i class="menu-icon tf-icons bx bx-copy"></i>Cetak Kartu spp
                                </strong></a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('wali.tagihan.detail') }}" class="btn btn-primary mt-3 w-25">Bayar</a>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
