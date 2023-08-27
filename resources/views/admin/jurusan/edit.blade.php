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
                    <h5 class="card-header">Edit Jurusan</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <form action="{{ route('admin.jurusan.update', ['jurusan' => $jurusan->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="id_angkatans">Angkatan</label>
                                    <select name="id_angkatans" id="id_angkatans" class="form-control" required>
                                        <option disabled selected>-----------</option>
                                        @foreach ($angkatan as $item)
                                            <option value="{{$item->id}}" {{ old('id_angkatans', $jurusan->angkatans->id) == $item->id ? 'selected' : '' }} required>{{ $item->tahun }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_angkatans')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Jurusan</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $jurusan->nama) }}">
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
@endsection
