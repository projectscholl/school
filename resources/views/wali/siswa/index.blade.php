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
                    <h5 class="card-header">Data Siswa</h5>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NAMA</th>
                                    <th>KELAS</th>
                                    <th>ANGKATAN</th>
                                    <th>Kartu SPP</th>
                                    <th>BIAYA SEKOLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wali as $index => $item)
                                    <tr>
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>
                                                {{ $index + 1 }}
                                            </strong>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->angkatan->tahun }}</td>
                                        <td>
                                            <strong>
                                                <a href="{{ route('admin.spp.pdf', ['id_users' => $item->id]) }}"><i class="menu-icon tf-icons bx bx-copy ms-2"></i>Download</a>
                                            </strong>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            @if ($item->angkatan && $item->angkatan->biaya)
                                                Rp {{ number_format($item->angkatan->biaya->total_biaya) }}
                                            @else
                                                Tidak ada Biaya
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
