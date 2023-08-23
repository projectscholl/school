@extends('layouts.master')

@section('content')
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
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('auto-dismiss-alert').remove();
                            }, 2000);
                        </script>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('delete') }}!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('auto-dismiss-alert').remove();
                            }, 2000);
                        </script>
                    @endif
                    @if (session('pesan'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('pesan') }}!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="card-header">Data Biaya Tables</h5>
                    <a href="{{ route('admin.biaya.create') }}" class="btn btn-primary col-2 ms-4">Tambah Data</a>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Biaya</th>
                                        <th>tahun</th>
                                        <th>dibuat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($biaya as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->angkatans->tahun }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td class="d-flex">

                                                <a href="{{ route('admin.biaya.edit', $value->id) }}"
                                                    class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.biaya.destroy', $value->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i class="bx bx-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
