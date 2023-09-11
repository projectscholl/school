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
                                        <td>Nama Murid : <strong>{{ $murid->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Wali Murid : <strong>{{ $murid->User->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Angkatan : <strong>{{ $murid->angkatans->tahun }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan : <strong> {{ $murid->jurusans->nama }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas : <strong>{{ $murid->kelas->kelas }}</strong></td>
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
                                    {{-- <tr>
                                        <td>Status Tagihan : <strong>Belum Dibayar</strong></td>
                                    </tr> --}}
                                    <tr>
                                        @foreach ($id_tagihans as $item)
                                            {{ $item }}
                                        @endforeach
                                        <td>Total Dibayar : <strong class="">Rp {{ number_format($tagihans) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="container mx-auto d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('wali.tagihan.bayar', ['id' => $tagihans, 'idmurid' => $murid->id]) }}" class="btn btn-primary my-4 w-50 text-light">Bayar Bank</a>
                                <a class="btn btn-primary my-4 w-50 text-light">iPaymu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection