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
                                <div>NAMA :  {{ $murids->name }} </div>
                                <hr>
                                <div>ANGKATAN : {{ $murids->angkatans->tahun ?? 'Tidak ada Angkatan' }} </div>
                                <hr>
                                <div>JURUSAN : {{ $murids->jurusans->nama }} </div>
                                <hr>
                                <div>KELAS : {{ $murids->kelas->kelas ?? 'Tidak ada Kelas' }} </div>
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
