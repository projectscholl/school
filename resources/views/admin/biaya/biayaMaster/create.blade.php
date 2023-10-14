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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Biaya Bawaan /</span>
                    Biaya
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
                            <form action="{{ route('admin.masterBiaya.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Nama harga</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Harga</label>
                                    <input type="text" name="harga" id="harga" class="form-control"
                                        value="{{ old('harga') }}">
                                    @error('harga')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.masterBiaya.index') }}" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('sneat/js/jquery.mask.min.js') }}"></script>
    <script>
        $('#harga').mask("#.##0", {
            reverse: true
        });
    </script>
@endpush
