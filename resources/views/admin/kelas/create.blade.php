@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data kelas</h5>
                        <p>*Harus Mempunyai Data angkatan dan Jurusan terlebih dahulu!*</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kelas.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="" class="form-control">
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="" class="form-control">
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kelas">Masukkan kelas</label>
                                <input type="number" placeholder="10" class="form-control" name="kelas">
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
