@extends('layouts.master')

@section('title', 'Laporan')
@section('content')
    @include('layouts.sidebar')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">Data Laporan</div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Laporan Pembayaran</h4>
                        <div class="pe-5 me-5">
                            <form action="">
                                <label for="" class="mb-2">Pilih Tahun Laporan</label>
                                <input type="date" name="" id="" class="form-control">
                                <a href=""
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
