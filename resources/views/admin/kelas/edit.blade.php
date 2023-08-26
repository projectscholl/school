@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5>Ubah Data Kelas</h5>
                        <p>*Harus Mempunyai Data angkatan dan Jurusan terlebih dahulu!*</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="" class="form-control">
                                    <option disabled>disable</option>
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $kelas->id_angkatans == $data->id ? 'selected' : 'belum pilih' }}>
                                            {{ $data->tahun }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="" class="form-control">
                                    <option>Data jurusan</option>
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $kelas->id_jurusans == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kelas">Masukkan kelas</label>
                                <input type="number" placeholder="10" class="form-control" name="kelas"
                                    value="{{ $kelas->kelas }}">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
