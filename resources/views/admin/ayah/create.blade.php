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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data Ayah /</span>
                    Ayah
                </h4>
                <div class="card">
                    {{-- @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                 
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('delete') }}!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                    
                    @endif --}}

                    <h5 class="card-header">Tambah</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <form action="{{ route('admin.AyahMurid.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Telepon</label>
                                    <input type="number" name="telepon" id="email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Masukkan Agama</label>
                                    <select name="agama" id="" class="form-control">
                                        <option selected>--Pilih--</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Ateis">Ateis</option>
                                    </select>
                                    @error('agama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control" placeholder="kuli">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Masukkan Pendidikan terakhir</label>
                                    <select name="pendidikan" id="" class="form-control">
                                        <option selected>--Pilih--</option>
                                        <option value="SD">SD -sederajat</option>
                                        <option value="SMP">SMP -sederajat</option>
                                        <option value="SMA">SMA -sederajat</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    @error('pendidikan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.AyahMurid.index') }}" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
