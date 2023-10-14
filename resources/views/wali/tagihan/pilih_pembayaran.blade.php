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
                                <tbody class="table-border-bottom-">
                                    <tr>
                                        <td>Status Tagihan : <strong>Belum Dibayar</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Total Dibayar : <strong class="">Rp {{ number_format($tagihans) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="mb-3">Tagihan Yang Dibayar : 
                                            <table class="table table-bordered mt-2">
                                                <thead>
                                                    <tr>
                                                        <th>Tagihan</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tagihanDetails as $tagihanDetail)
                                                        <tr>
                                                            <td>@if ($tagihanDetail->tagihan->biayas->jenis_biaya === 'routine')
                                                                <strong>@if ($tagihanDetail->end_date)
                                                                    {{ \Carbon\Carbon::createFromFormat('d-m', $tagihanDetail->end_date)->format('F') }}
                                                                @else
                                                                    -
                                                                @endif</strong>
                                                            @elseif ($tagihanDetail->tagihan->biayas->jenis_biaya === 'tidakRoutine')
                                                                {{ $tagihanDetail->tagihan->nama_biaya }}
                                                            @else
                                                                Jenis Tidak Diketahui
                                                            @endif</td>
                                                            <td>Rp {{ number_format($tagihanDetail->tagihan->amount) }}</td> 
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="container mx-auto d-flex justify-content-center align-items-center gap-2">
                                <form action="{{ route('wali.tagihan.bayar', ['id' => $id, 'idmurid' => $murid->id]) }}"
                                    method="POST" class="w-50">
                                    @csrf
                                    @foreach ($tagihanDetails as $tagihanDetail)
                                        <input type="hidden" name="tagihanDetails[]" value="{{ $tagihanDetail->id }}">
                                    @endforeach
                                    <button class="btn btn-primary my-4 w-100 text-light">Bayar Bank</button>
                                </form>
                                <form action="{{ route('wali.tagihan.pay-ipaymu', ['id' => $id, 'idmurid' => $murid->id]) }}"
                                    method="POST" class="w-50">
                                    @csrf
                                    @method('POST')
                                    @foreach ($tagihanDetails as $tagihanDetail)
                                        <input type="hidden" name="tagihanDetails[]" value="{{ $tagihanDetail->id }}"
                                            class="@error('tagihanDetails[]')
                                        @enderror">
                                    @endforeach
                                    <input type="hidden" name="total" value="{{ $tagihans }}">
                                    <button class="btn btn-primary my-4 w-100 text-light">Pembayaran Online</button>
                                </form>
                                {{-- <a href="{{ route('tagihan.pay-ipaymu', ['id' => $id, 'idmurid' => $murid->id]) }}"
                                    class="btn btn-primary my-4 w-50 text-light">iPaymu</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
