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
                    <h5 class="card-header">Tambah Angkatan</h5>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="nama">Nama Angkatan</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama Biaya">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Total Biaya</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama Biaya">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
