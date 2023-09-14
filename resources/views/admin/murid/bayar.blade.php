@extends('layouts.master')

@section('title', 'Siswa')
@section('content')
    <!-- Layout wrapper -->
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Bayar</h5>
                    </div>
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
                                        <th class="text-white">Murid Information</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>Total Pembayaran : <strong>Rp.{{ number_format($total) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
