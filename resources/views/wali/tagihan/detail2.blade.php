@extends('layouts.master')

@section('title, detail')
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
                                        <td>Nama Murid : <strong>Suherman</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Wali Murid : <strong>Lisa blackwhite</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas : <strong>12</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan : <strong>Teknik Komputer</strong></td>
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
                                        <td>Total Tagihan : <strong class="">100.000</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="container mx-auto d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('wali.tagihan.bayar') }}" class="btn btn-primary my-4 w-50 text-light">Bayar Bank</a>
                                <a class="btn btn-primary my-4 w-50 text-light">iPaymu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection