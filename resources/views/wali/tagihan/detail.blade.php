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
                    <h5 class="card-header mb-4">Tagihan <strong>{{ $murid->name }}</strong></h5>
                    <div class="card-body">
                        <div>NAMA : {{ $murid->name }}</div>
                        <hr>
                        <div>ANGKATAN : {{ $murid->angkatans->tahun }}</div>
                        <hr>
                        <div>JURUSAN : {{ $murid->jurusans->nama }}</div>
                        <hr>
                        <div>KELAS : {{ $murid->kelas->kelas }}</div>
                        <hr>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 order-2 mt-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class=" m-0 me-2">{{ $tagihan->nama_biaya }}</h5>
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
                                    @foreach ($bulan as $bulans)
                                        <tr>
                                            <td>{{ $bulans->mounth?? '-' }}</td>
                                            <td>Rp {{ number_format($bulans->amount) }}</td>
                                            <td>
                                                <div class="text-danger">
                                                    <strong>
                                                            <div class="text-{{ $bulans->status == 'SUDAH' ? 'success' : 'danger' }}">{{$bulans->status}}</div>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- <a href="{{ route('spp') }}" class="btn btn-primary"><strong>
                                        <i class="menu-icon tf-icons bx bx-copy"></i>Cetak Kartu spp
                                    </strong></a> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('wali.tagihan.pembayaran', $tagihan->id).'?idmurid='.$murid->id }}" class="btn btn-primary me-2 mt-3 w-25">Detail</a>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
