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
                            <form action="{{ route('admin.murid.bayar.proses', $murid->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered">
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
                                <table class="table table-bordered mb-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-white">Murid Information</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>Total Pembayaran :
                                                <strong>Rp.{{ number_format($total, 2, ',', '.') }}</strong>
                                                <input type="hidden" name="total_bayar" value="{{ $total }}">
                                                @foreach ($tagihan as $item)
                                                    <input type="hidden" name="id[]" value="{{ $item }}">
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
