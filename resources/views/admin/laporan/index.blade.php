@extends('layouts.master')

@section('title', 'Laporan')
@section('content')
    @include('layouts.sidebar')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Laporan Pembayaran</h4>
                        <div class="pe-5 me-5">
                            <form action="">
                                <label for="" class="mb-2">Pilih Tahun Laporan</label>
                                <select name="" id="" class="form-control">
                                    <option value="">2021</option>
                                    <option value="">2022</option>
                                    <option value="">2023</option>
                                    <option value="">2024</option>
                                </select>
                                <a href="{{ route('admin.laporan.pembayaran') }}"
                                    class="d-flex align-items-center justify-content-around px-5 btn btn-primary mt-3 col-md-2">
                                    <i class='bx bx-book-content'></i>
                                    Cetak
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Laporan Tagihan</h4>
                        <div class="pe-5 me-5">
                            <form action="">
                                <label for="" class="mb-2">Pilih Tahun Laporan</label>
                                <select name="" id="" class="form-control">
                                    <option value="">2021</option>
                                    <option value="">2022</option>
                                    <option value="">2023</option>
                                    <option value="">2024</option>
                                </select>
                                <a href="{{ route('admin.laporan.tagihan') }}"
                                    class="d-flex align-items-center justify-content-around px-5 btn btn-primary mt-3 col-md-2">
                                    <i class='bx bx-book-content'></i>
                                    Cetak
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
