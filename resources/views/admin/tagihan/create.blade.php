@extends('layouts.master')

@section('title', 'Tagihan create')
@section('content')
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
                    <h5 class="card-header">Tambah Data Tagihan</h5>
                    <div class="card-body w-50">
                        <div class="table-responsive text-nowrap">
                            <form action="{{ route('admin.tagihan.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-group mb-3">
                                    <label for="nama">Pilih Biaya Angkatan</label>
                                    <select name="id_siswa" id="" class="form-control">
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
                                <button type="submit" class="btn btn-primary">Submit</button>
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
