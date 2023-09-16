@extends('layouts.master')

@section('title', 'Pembayaran')
@section('content')

    <!-- Layout container -->
    <div class="layout-page">

        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ session('pesan') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="card-header">Data Pembayaran</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Murid</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Tanggal Konfirmasi</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayarans as $index => $pembayar)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $pembayar->name ?? 'Tidak Ada Murid' }}</strong>
                                            </td>
                                            </td>
                                            <td>
                                                @if ($pembayar->payment_links)
                                                    iPaymu
                                                @else
                                                    Bank
                                                @endif
                                            </td>
                                            <td>{{ $pembayar->payment_status }}</td>
                                            <td>{{ $pembayar->updated_at ? $pembayar->updated_at->format('d/m/Y') : '-' }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.pembayaran.detail', $pembayar->id) }}"
                                                    class="btn btn-warning me-2"><i class='tf-icons bx bx-detail'></i>
                                                    Detail</a>
                                                <form action="">
                                                    <button class="btn btn-danger"><i class='bx bx-trash'></i>
                                                        Hapus</button>
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
        </div>
    </div>
@endsection
