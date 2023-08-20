@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    @include('layouts.sidebar')

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
                                <div>NAMA :  {{ $murids->name }} </div>
                                <hr>
                                <div>KELAS : {{ $murids->kelas }} </div>
                                <hr>
                                <div>JURUSAN : {{ $murids->jurusan }} </div>
                                <hr>
                                <div>ANGKATAN : {{ $murids->angkatan->tahun ?? 'Tidak ada Angkatan' }} </div>
                                <hr>
                                <div>BIAYA : Rp {{ number_format($murids->angkatan->biaya->total_biaya) }} </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!--/ Bordered Table -->
                </div>
            </div>
        </div>
    </div>
@endsection
