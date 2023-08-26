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
                    <h5 class="card-header">Tambah Biaya</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.biaya.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Biaya</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukkan Nama Biaya">
                                </div>
                                <label for="nama">Angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control mb-3">
                                    <option disabled selected>-------</option>
                                    @foreach ($angkatan as $item)
                                        <option value="{{ $item->id }}" required>{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                                <label for="nama">Jurusan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control mb-3">
                                    <option disabled selected>-------</option>
                                    @foreach ($angkatan as $item)
                                        <option value="{{ $item->id }}" required>{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                                <label for="nama">Kelas</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control mb-3">
                                    <option disabled selected>-------</option>
                                    @foreach ($angkatan as $item)
                                        <option value="{{ $item->id }}" required>{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Total Biaya</label>
                                <input type="number" class="form-control" name="total_biaya" id="total_biaya"
                                    placeholder="Masukkan Total Biaya">
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
