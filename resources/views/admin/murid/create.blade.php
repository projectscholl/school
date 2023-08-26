@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->

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
                        <form action="{{ route('admin.murid.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nama Wali</label>
                                <select name="id_users" id="id_users" class="form-control" >
                                    <option disabled selected>-----------</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_users')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">NISN</label>
                                <input type="text" class="form-control" name="nisn" id="nisn"
                                placeholder="Masukkan NISN" required>
                                @error('nisn')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach ($biaya as $item)
                                        <option value="{{ $item->angkatan->id }}">{{ $item->angkatan->tahun }}</option>
                                    @endforeach
                                </select>
                                @error('id_angkatans')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach (['teknik mesin', 'teknik komputer'] as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach (['10', '11', '12'] as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Jl.chicago" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
