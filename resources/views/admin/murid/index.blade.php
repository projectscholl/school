@extends('layouts.master')

@section('title', 'Siswa')
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
                    <h5 class="card-header">Murid Tables</h5>
                    <a href="{{ route('admin.murid.create') }}" class="btn btn-primary col-2 ms-4">Tambah Murid</a>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Wali</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Kelas</th>
                                        <th>Angkatan</th>
                                        <th>Biaya</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($murids as $index => $item)
                                        <tr>
                                            <td>
                                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>
                                                    {{ $index + 1 }}
                                                </strong>
                                            </td>
                                            <td>
                                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $item->User->name ?? 'Tidak ada wali murid' }}</strong>
                                            </td>
                                            <td><strong>{{ $item->name }}</strong></td>
                                            <td>{{ $item->jurusan }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->angkatan->tahun ?? 'Tidak ada Angkatan' }}</td>
                                            <td>{{ $item->id_biaya ?? 'Tidak ada Biaya' }}</td>
                                            <td class="d-flex">

                                                <a href="{{ route('admin.murid.show', $item->id) }}"
                                                    class="btn btn-primary me-2"><i class="bx bx-detail"></i>
                                                </a>
                                                <a href="{{ route('admin.murid.edit', $item->id) }}"
                                                    class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.murid.destroy', $item->id) }}"
                                                    method="POST">
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
