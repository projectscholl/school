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
                    <h5 class="card-header mt-3">Data Tagihan</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tagihan</th>
                                        <th>Jenis Tagihan</th>
                                        <th>Nama Murid</th>
                                        <th>Angkatan</th>
                                        <th>Jurusan</th>
                                        <th>Kelas</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nomor = 1;
                                    @endphp
                                    @foreach ($biayaItems as $tagihans)
                                        @foreach ($tagihans->murids as $murid)
                                                @if ($murid->id_users == Auth::user()->id)
                                                    <tr>
                                                        <td>{{ $nomor }}</td>
                                                        <td>{{ $tagihans->nama_biaya }}</td>
                                                        <td>
                                                            @if ($tagihans->jenis_biaya === 'tidakRoutine')
                                                                <strong>Tidak Rutin</strong>
                                                            @elseif ($tagihans->jenis_biaya === 'routine')
                                                                <strong>Rutin</strong>
                                                            @else
                                                                Jenis Tidak Diketahui
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $murid->name ?? 'Tidak Ada Data Murid' }}<br>
                                                        </td>
                                                        <td>{{ $murid->angkatans->tahun ?? 'Tidak Ada Data Angkatan' }}</td>
                                                        <td>{{ $murid->jurusans->nama ?? 'Tidak Ada Data Jurusan' }}</td>
                                                        <td>{{ $murid->kelas->kelas ?? 'Tidak Ada Data Kelas' }}</td>
                                                        <td class="d-flex">
                                                            <a href="{{ route('wali.tagihan.pembayaran', ['id' => $tagihans->id, 'idmurid' => $murid->id]) }}" class="btn btn-primary me-2">Detail</a>
                                                            {{-- <a href="#" class="btn btn-primary me-2">Detail</a> --}}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @php
                                                $nomor++;
                                            @endphp
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
