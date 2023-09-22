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
                        {{-- <div>NAMA : {{ $murid->name }}</div>
                        <hr>
                        <div>ANGKATAN : {{ $murid->angkatans->tahun }}</div>
                        <hr>
                        <div>JURUSAN : {{ $murid->jurusans->nama }}</div>
                        <hr>
                        <div>KELAS : {{ $murid->kelas->kelas }}</div>
                        <hr> --}}

                        <h5 class=" m-0 me-2 mb-3">{{ $tagihan->nama_biaya }}</h5>
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
                                @php
                                    $tagihanDetails = App\Models\TagihanDetail::where('id_tagihan', $bulans->id)->where('id_murids', $murid->id)->get();
                                @endphp
                                    @foreach ($tagihanDetails as $tagihanDetail)
                                        <tr>
                                            <td>{{ $bulans->mounth?? '-' }}</td>
                                            <td>Rp {{ number_format($bulans->amount) }}</td>
                                            <td>
                                                <div class="text-danger">
                                                    <strong>
                                                            <div class="text-{{ $tagihanDetail->status == 'SUDAH' ? 'success' : 'danger' }}">{{$tagihanDetail->status}}</div>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                {{-- <a href="{{ route('spp') }}" class="btn btn-primary"><strong>
                                    <i class="menu-icon tf-icons bx bx-copy"></i>Cetak Kartu spp
                                </strong></a> --}}
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 order-2 mt-4">
                    
                </div>
                <a href="{{ route('wali.tagihan.pembayaran', ['id' => $tagihan->id, 'idmurid' => $murid->id]) }}" class="btn btn-primary mt-2 w-25">Detail</a>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
