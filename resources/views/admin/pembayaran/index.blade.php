@extends('layouts.master')

@section('title', 'Pembayaran')
@section('content')
    @include('layouts.sidebar')

    <!-- Layout container -->
    <div class="layout-page">

        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">Data Pembayaran</h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Murid</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Status</th>
                                            <th>Tanggal Konfirmasi</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Jono</strong>
                                            </td>
                                            <td>Online</td>
                                            <td>Confirmed</td>
                                            <td>31/02/2090</td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.pembayaran.detail') }}" class="btn btn-warning me-2"><i
                                                        class='tf-icons bx bx-detail'></i>
                                                    Detail</a>
                                                <form action="">
                                                    <button class="btn btn-danger"><i class='bx bx-trash'></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Jono</strong>
                                            </td>
                                            <td>Transfer</td>
                                            <td><strong>Pending</strong></td>
                                            <td>31/02/2090</td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.pembayaran.detail') }}" class="btn btn-warning me-2"><i
                                                        class='tf-icons bx bx-detail'></i>
                                                    Detail</a>
                                                <form action="">
                                                    <button class="btn btn-danger"><i class='bx bx-trash'></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
