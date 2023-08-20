@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
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
                    <h5 class="card-header">Edit Biaya</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.biaya.update' , ['biaya' => $biaya->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nama">Nama Biaya</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Masukkan Nama Biaya" value="{{ old('nama', $biaya->nama) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @if ($biaya->angkatan)
                                        @foreach ($angkatan as $item)
                                            <option value="{{ $item->id }}" {{ old('id_angkatans', $biaya->angkatan->id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->tahun }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" selected>Tidak Ada Angkatan</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Total Biaya</label>
                                <input type="number" class="form-control" name="total_biaya" id="total_biaya"
                                    placeholder="Masukkan Biaya" value="{{ old('total_biaya', $biaya->total_biaya) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
