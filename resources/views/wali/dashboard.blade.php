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
                                                    Kamu mendapatkan <span class="fw-bold">10</span> notifikasi
                                                    konfirmasi belum
                                                    kamu lihat klik untuk melihat
                                                </p>

                                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">Lihat
                                                    Notifikasi</a>
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
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    </div>
                                </div>
                            </div>
                            <!-- Total Revenue -->
                            <!--/ Total Revenue -->
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
                        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
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
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
