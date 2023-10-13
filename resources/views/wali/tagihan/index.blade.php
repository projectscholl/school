@extends('layouts.master')

@section('title', 'Tagihan')
@section('content')
    <!-- Layout wrapper -->

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <h5 class="card-header">Data Tagihan</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Murid</th>
                                        <th>Angkatan</th>
                                        <th>Jurusan</th>
                                        <th>Kelas</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($biayaItems as $index => $tagihans)
                                        @foreach ($tagihans->murids as $index => $murid)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $murid->name ?? 'Tidak Ada Data' }}<br>
                                                </td>
                                                <td>{{ $tagihans->angkatans->tahun ?? 'Tidak Ada Data' }}</td>
                                                <td>{{ $tagihans->jurusans->nama ?? 'Tidak Ada Data' }}</td>
                                                <td>{{ $tagihans->kelas->kelas ?? 'Tidak Ada Data' }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('wali.tagihan.detail', ['id' => $tagihans->id, 'idmurid' => $murid->id]) }}"
                                                        class="btn btn-primary me-2">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
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
