@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->
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
                    <h5 class="card-header">Tambah Murid</h5>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Nama Wali</label>
                                <select name="wali" id="wali" class="form-control">
                                    <option disabled selected>-----------</option>
                                    <option value="">Asep</option>
                                    <option value="">Rahman</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">NISN</label>
                                <input type="text" class="form-control" name="nisn" id="nisn"
                                    placeholder="Masukkan NISN">
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Angkatan</label>
                                <select name="angkatan" id="angkatan" class="form-control">
                                    <option disabled selected>-----------</option>
                                    <option value="">2022</option>
                                    <option value="">2023</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option disabled selected>-----------</option>
                                    <option value="">RPL</option>
                                    <option value="">Multimedia</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Kelas</label>
                                <input type="number" class="form-control" name="kelas" id="kelas">
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
