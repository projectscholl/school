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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Ibu Murid /</span>
                    Ibu {{ $ibu->name }}
                </h4>
                <div class="card">
                    <h5 class="card-header">Detail Ibu {{ $ibu->name }}</h5>
                    <div class="card-body">
                        <div>FOTO : <img src="{{ asset('storage/image/' . $ibu->image) }}" alt="" width="100px"
                                class="rounded-circle">
                        </div>
                        <hr>
                        <div>NAMA : {{ $ibu->name }} </div>
                        <hr>
                        <div>EMAIL : {{ $ibu->email }} </div>
                        <hr>
                        <div>Nomor Telepon : {{ $ibu->telepon }}</div>
                        <hr>
                        <div>Alamat : {{ $ibu->alamat }}</div>
                        <hr>
                        <div>Dibuat : {{ $ibu->created_at }} </div>
                        <hr>
                        <div>Di Update : {{ $ibu->updated_at }}</div>
                        <hr>


                        <h3 class="mt-4">Data Anak</h3>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anak as $index => $anaks)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $anaks->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
