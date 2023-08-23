@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->

    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <div class="card">
                    <h5 class="card-header">Data Tagihan Tables</h5>
                    <a href="{{ route('admin.tagihan.create') }}" class="btn btn-primary col-2 ms-4">Tambah Data</a>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama Murid</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Tenggat Tagihan</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1234567891</td>
                                        <td>Ahmad Sawiji</td>
                                        <td>1/12/2023</td>
                                        <td>1/1/2024</td>
                                        <td>Rp 300.000.00</td>
                                        <td>LUNAS</td>
                                        <td class="d-flex">

                                            <a href="{{ route('admin.tagihan.show', ['tagihan' => 1]) }}"
                                                class="btn btn-primary me-2"><i class="bx bx-edit-alt"></i>
                                            </a>
                                            <form action="">
                                                <button class="btn btn-danger"><i class="bx bx-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
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
