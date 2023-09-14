@extends('layouts.master')

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
                <div class="card">
                    <h5 class="card-header">Detail Murid</h5>
                    <div class="card-body">
                        <div>NAMA : {{ $murids->name }} </div>
                        <hr>
                        <div>ANGKATAN : {{ $murids->angkatans->tahun ?? 'Tidak ada Angkatan' }} </div>
                        <hr>
                        <div>JURUSAN : {{ $murids->jurusans->nama }} </div>
                        <hr>
                        <div>KELAS : {{ $murids->kelas->kelas ?? 'Tidak ada Kelas' }} </div>
                        <hr>
                    </div>
                </div>
                <!-- Transactions -->
                <div class="card mt-3">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me<td>-2">Total Tagihan</h5>
                        </td>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="">
                            <form action="{{ route('admin.murid.bayar', $murids->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered mb-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tagihan</th>
                                            <th>Tanggal Penagihan</th>
                                            <th>Total Tagihan</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($tagihanDetail != null)
                                            @foreach ($tagihanDetail as $key => $tagihan)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $tagihan->nama_biaya }}</td>
                                                    <td>{{ Carbon\Carbon::parse($tagihan->start_date)->toFormattedDateString() }}
                                                    </td>
                                                    <td>Rp {{ number_format($tagihan->jumlah_biaya, 2, ',', '.') }}</td>
                                                    <td><input type="checkbox" name="total[]"
                                                            value="{{ $tagihan->jumlah_biaya }}"></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-100">null</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <button type="submit" href="" class="btn btn-primary">Bayar</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
