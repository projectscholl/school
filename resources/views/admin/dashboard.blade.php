@extends('layouts.master')

@section('title', 'Admin')
@section('content')
    <!-- Layout wrapper -->
    <!-- Menu -->
    <!-- sidebar -->
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
                    <div class="col-lg-8 mb-4 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Selamat Datang
                                            {{ $user->name }}
                                            🎉</h5>
                                        <p class="mb-4">
                                            Kamu mendapatkan <span class="fw-bold">10</span> notifikasi
                                            konfirmasi belum dilihat
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


                    <div class="col-lg-4 col-md-4 order-1">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ asset('sneat') }}/assets/img/icons/unicons/chart-success.png"
                                                    alt="chart success" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Total Murid</span>
                                        <h3 class="card-title mb-4">{{ $jumlahMurid }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ asset('sneat') }}/assets/img/icons/unicons/wallet-info.png"
                                                    alt="chart success" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Total Sudah Bayar</span>
                                        <h3 class="card-title mb-1">0</h3>
                                        <small class="text-success fw-semibold"><strong>Rp1.000.000</strong></small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Status Tagihan -->
                    <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Status Tagihan</h5>
                                </div>
                            </div>
                            <div class="card-body mt-5">
                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--- Status Tagihan -->
                    <!-- Status Tagihan -->
                    <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Status Pembayaran</h5>
                                </div>
                            </div>
                            <div class="card-body mt-5">
                                <canvas id="herChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--- Status Tagihan -->
                </div>
                {{-- <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                        <!-- Transactions -->
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Transactions</h5>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                        <!--/ Transactions -->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                        <!-- Transactions -->
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Transactions</h5>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                        <!--/ Transactions -->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                        <!-- Transactions -->
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Transactions</h5>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                        <!--/ Transactions -->
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        {{-- <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
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
        </footer> --}}
        <!-- / Footer -->


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var xValues = ["Lunas", "Belum Bayar"];
            var yValues = [55, 49];
            var barColors = [
                "#EEFBE7",
                "#e0f7fc",
            ];

            new Chart("myChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "World Wide Wine Production 2018"
                    }
                }
            });
        </script>

        <script>
            var xValues = ["Dikonfirmasi", "Belum Dikonfirmasi"];
            var yValues = [55, 49];
            var barColors = [
                "#EEFBE7",
                "#e0f7fc",
            ];

            new Chart("herChart", {
                type: "doughnut",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "World Wide Wine Production 2018"
                    }
                }
            });
        </script>

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
