@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- / Sidebar -->

    <!-- Layout container -->
    <div class="layout-page">

        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-10 mb-4 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Selamat Datang
                                            {{ Auth::user()->name }}
                                            🎉</h5>
                                        <p class="mb-4">
                                            Kamu mendapatkan <span class="fw-bold">{{ $notifikasiMurids }}</span> notifikasi
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <img src="{{ asset('sneat') }}/assets/img/illustrations/man-with-laptop-light.png"
                                            height="140" alt="View Badge User"
                                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 order-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ asset('sneat') }}/assets/img/icons/unicons/chart-success.png"
                                                    alt="chart success" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block">Total Anak</span>
                                        <h3 class="card-title mb-4">{{ $jumlahMurid }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-6">
                            </div>
                        </div>
                    </div>
                    <!-- Total Revenue -->
                    <!--/ Total Revenue -->
                </div>
                <div class="row">

                    <div class="col-md-8">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- Kartu SPP -->
                                @foreach ($kartuSPPs as $kartuSPP)
                                    <div class="col-md-6 order-0 mb-4">
                                        <div class="card h-100">
                                            <div>
                                                <div
                                                    class="card-header d-flex align-items-center justify-content-between pb-0">
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-0 me-2">Kartu SPP
                                                            <strong>{{ $kartuSPP['nama_murid'] }}</strong></h5>
                                                    </div>
                                                    <div class="menu-icon">
                                                        <a href="{{ route('admin.spp.pdf', ['id_murids' => $kartuSPP['id_murids']]) }}"
                                                            class="btn btn-primary me-2"><i class="bx bx-detail"></i>
                                                        </a>
                                                    </div>
                                                    {{-- <button type="button" class="btn btn-primary me-2"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        <strong>
                                                            <i class="menu-icon tf-icons bx bx-copy ms-2 "></i>
                                                        </strong>
                                                    </button>
                                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                        data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @include('admin.pdf.spp-pdf')
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <form
                                                                        action="{{ route('admin.pdf.downloadPdf', ['id_murids' => $murid->id]) }}">
                                                                        <button
                                                                            type="submit"class="btn btn-link btn-primary">
                                                                            <strong>
                                                                                <i
                                                                                    class="menu-icon tf-icons bx bx-download ms-2 "></i>Unduh
                                                                            </strong>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead class="bg-dark">
                                                        <tr>
                                                            <th class="text-white">Bulan</th>
                                                            <th class="text-white">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kartuSPP['bulan'] as $bulan)
                                                            <tr>
                                                                <td>{{ $bulan }}</td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-label-{{ $kartuSPP['status'] == 'SUDAH' ? 'success' : 'danger' }}">
                                                                        {{ $kartuSPP['status'] }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!--/ Kartu SPP -->
                            </div>
                        </div>
                    </div>
                    <!--/ Kartu SPP -->
                    <!-- Notifikasi -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div>
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Notifikasi</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column" style="max-height: 480px; overflow-y: auto;">
                                    @foreach ($tagihanMurids as $tagihanMurid)
                                        @if ($tagihanMurid->status == 'BELUM')
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                {{ $tagihanMurid->nama_biaya }}
                                                <strong>{{ $tagihanMurid->murids->name }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- Notifikasi -->
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by
                        <a href="https://themeselection.com" target="_blank"
                            class="footer-link fw-bolder">ThemeSelection</a>
                    </div>
                    <div>
                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More
                            Themes</a>

                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                            target="_blank" class="footer-link me-4">Documentation</a>

                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                            class="footer-link me-4">Support</a>
                    </div>
                </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>


    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (session('pembayaranBelum_Dikonfirmasi'))
            Swal.fire({
                icon: 'info',
                title: 'Notifikasi Pembayaran',
                text: "{{ session('pembayaranBelum_Dikonfirmasi') }}",
                showConfirmButton: true,
                timer: 3000,
                timerProgressBar: true,
            });
        endif
    </script>
@endsection
