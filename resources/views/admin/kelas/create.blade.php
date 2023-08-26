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
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="">Masukkan angkatan</label>
                                <select name="" id="" class="form-control">
                                    <option value="">2022</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Masukkan Jurusan</label>
                                <select name="" id="" class="form-control">
                                    <option value="">IPA 1</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Masukkan kelas</label>
                                <input type="text" placeholder="10" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
