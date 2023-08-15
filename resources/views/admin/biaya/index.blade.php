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
                    <h5 class="card-header">Data Biaya Tables</h5>
                    <a href="{{ route('admin.biaya.create') }}" class="btn btn-primary col-2 ms-4">Tambah Data</a>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Biaya</th>
                                        <th>Total Tagihan</th>
                                        <th>Dibuat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>SPP Angkatan 2022</td>
                                    <td>Rp 200.000.00</td>
                                    <td>admin</td>
                                    <td class="d-flex">

                                        <a href="{{ route('admin.biaya.edit', ['biaya' => 1]) }}"
                                            class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="">
                                            <button class="btn btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
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
