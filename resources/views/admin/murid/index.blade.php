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
                    <h5 class="card-header">Murid Tables</h5>
                    <a href="{{ route('admin.murid.create') }}" class="btn btn-primary col-2 ms-4">Tambah Murid</a>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Wali</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Kelas</th>
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
                                                <strong>Sudarmono</strong>
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jurusan }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>Rp 15.000.000.00</td>
                                            <td class="d-flex">

                                                <a href="{{ route('admin.murid.show', ['murid' => 1]) }}"
                                                    class="btn btn-primary me-2"><i class="bx bx--alt"></i>
                                                </a>
                                                <a href="{{ route('admin.murid.edit', ['murid' => 1]) }}"
                                                    class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i>
                                                </a>
                                                <form action="">
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
