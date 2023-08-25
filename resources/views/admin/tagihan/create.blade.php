@extends('layouts.master')

@section('title', 'Tagihan create')
@section('content')
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
                    <div class="card-header">
                        <h5>Tambah Data Tagihan</h5>
                        <p>*Silahkan membuat Tagihan berdasarkan Nama biaya*</p>
                    </div>

                    <div class="card-body w-50">
                        <div class="table-responsive text-nowrap">
                            <form action="{{ route('admin.tagihan.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-group mb-3">
                                    <label for="nama">Pilih Biaya Angkatan</label>
                                    <select name="id_murid" id="" class="form-control">
                                        @foreach ($murids as $key => $value)
                                            <option value="{{ $key }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_date">Tanggal Tagihan </label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        placeholder="Masukkan Nama Biaya">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_date">Tenggat Tagihan </label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        placeholder="Masukkan Nama Biaya">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-floating">
                                        <textarea name="desc" id="floatingTextarea" class="form-control"></textarea>
                                        <label for="floatingTextarea">Keterangan Tagihan</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
