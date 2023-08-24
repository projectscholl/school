</html>@extends('layouts.master')

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
                    <h5 class="card-header">Pembayaran Bank</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            {{-- <form action="#" method="" enctype="multipart/form-data"> --}}
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Nama Pengirim</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Pengirim">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Rekening Pengirim</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Nama Pengirim">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Rekening Operator</label>
                                    <select name="" id="" class="form-control">
                                        <option disabled>------</option>
                                        <option value="asep">Asep <strong>(8976544323k)</strong></option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Bukti Transfer</label>
                                    <input type="file" class="form-control" placeholder="Masukkan Nama Pengirim">
                                </div>
                                <div class="container mx-auto d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('wali.tagihan.result') }}" class="w-50">
                                    <button class="btn btn-primary my-4 w-50 text-light">Konfirmasi</button>
                                </a>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
