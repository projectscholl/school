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
                    <h5 class="card-header">Edit Murid</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.murid.update', ['murid' => $murid->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama" required value="{{ old('name', $murid->name) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nama Wali</label>
                                <select name="id_users" id="id_users" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @if ($murid->id_users)
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_users', $murid->id_users) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected>Tidak Ada Wali</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">NISN</label>
                                <input type="text" class="form-control" name="nisn" id="nisn"
                                    placeholder="Masukkan NISN" required value="{{ old('nisn', $murid->nisn) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach (['teknik mesin', 'teknik komputer'] as $item)
                                        <option value="{{ $item }}"
                                            {{ old('jurusan', $murid->jurusan) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach (['10', '11', '12'] as $item)
                                        <option value="{{ $item }}"
                                            {{ old('kelas', $murid->kelas) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @if ($murid->angkatan)
                                        @foreach ($angkatan as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_angkatans', $murid->angkatan->id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->tahun }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" selected>Tidak Ada Angkatan</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Jl.chicago" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
