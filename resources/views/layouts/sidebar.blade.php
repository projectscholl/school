    <!-- Sidebar -->

    @php
        $active = 'menu-item active';
        $nonActive = 'menu-item';
    @endphp
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme sidebar">
        <div class="app-brand demo mb-3" style="height: 100px;">
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center justify-content-center">
                    <a class="app-brand-link" href="{{ route('welcome') }}">
                        <img src="{{ asset('/storage/image/' . $instansi->logo) }}" alt="" width="50px"
                            height="50px">
                    </a>
                </div>
                <div class="mt-2">
                    <span class="demo menu-text fw-bolder ms-2 fs-3">{{ $instansi->name }}</span>
                </div>
            </div>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        @if (Auth::user()->role == 'WALI')
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="{{ Route::is('wali.dashboard') ? $active : $nonActive }}">
                    <a href="{{ route('wali.dashboard') }}" class="menu-link ">
                        <i class="menu-icon tf-icons bx bx-home"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <!-- Layouts -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">MASTER</span>
                </li>

                <!--Data Siswa-->
                <li class="{{ Route::is('wali.siswa.index*') ? $active : $nonActive }}">
                    <a href="{{ route('wali.siswa.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data Siswa</div>
                    </a>
                </li>

                <!--Data Tagihan-->
                <li class="{{ Route::is('wali.tagihan.*') ? $active : $nonActive }}">
                    <a href="{{ route('wali.tagihan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                        <div data-i18n="Without menu">Data Tagihan</div>
                    </a>
                </li>
                <!--Data Profile-->
                <li class="{{ Route::is('profile.*') ? $active : $nonActive }}">
                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Without menu">Profile</div>
                    </a>
                </li>
                <!--Logout-->
                <li class="menu-item" style="">
                    <a class="menu-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                        <i class="bx
                bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        @endif



        @if (Auth::user()->role == 'ADMIN')
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="{{ Route::is('admin.dashboard') ? $active : $nonActive }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link ">
                        <i class="menu-icon tf-icons bx bx-home"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <!-- Layouts -->

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">DATA TRANSAKSI</span>
                </li>
                {{-- <li class="{{ Route::is('admin.biaya.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.biaya.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                        <div data-i18n="Without menu">Data biaya</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ Route::is('admin.biaya.*', 'admin.masterBiaya.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                        <div data-i18n="Layouts">Data Biaya</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.biaya.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.biaya.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Management Biaya</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.masterBiaya.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.masterBiaya.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Biaya Bawaan</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--Data Pembayaran-->
                <li class="{{ Route::is('admin.pembayaran.*', 'admin.pembayaran.detail') ? $active : $nonActive }}">
                    <a href="{{ route('admin.pembayaran.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                        <div data-i18n="Without menu">Data Pembayaran</div>
                    </a>
                </li>
                <!--Account setting-->
                <li
                    class="menu-item {{ Route::is('admin.profile.*', 'admin.instansi.*', 'admin.bank.*', 'admin.pesan-whatsaap.index', 'admin.activity.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="Layouts">Account Setting</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.instansi.*', 'admin.bank.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.instansi.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Setting Instansi</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.profile.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.profile.edit', Auth::user()->id) }}" class="menu-link">
                                <div data-i18n="Without menu">Profile</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.pesan-whatsaap.index') ? $active : $nonActive }}">
                            <a href="{{ route('admin.pesan-whatsaap.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Notifications</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.activity.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.activity.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Activity user</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Layouts -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">DATA MASTER</span>
                </li>

                <!--Data Siswa-->
                <li class="{{ Route::is('admin.murid.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.murid.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data Siswa</div>
                    </a>
                </li>

                <!--Data Angakatan-->
                <li class="{{ Route::is('admin.angkatan.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.angkatan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Analytics">Data Angkatan</div>
                    </a>
                </li>

                <!--Data Jurusan-->
                <li class="{{ Route::is('admin.jurusan.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.jurusan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book"></i>
                        <div data-i18n="Analytics">Data Jurusan</div>
                    </a>
                </li>

                <!--Data Kelas-->
                <li class="{{ Route::is('admin.kelas.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.kelas.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">Data Kelas</div>
                    </a>
                </li>
                <!--Data Wali Murid-->
                <li class="{{ Route::is('admin.walimurid.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.walimurid.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data Wali Murid</div>
                    </a>
                </li>
                <!--Data Orang tua-->
                <li class="menu-item {{ Route::is('admin.AyahMurid.*', 'admin.IbuMurid.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Layouts">Data Orang Tua</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.AyahMurid.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.AyahMurid.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Data Ayah</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="{{ Route::is('admin.IbuMurid.*') ? $active : $nonActive }}">
                            <a href="{{ route('admin.IbuMurid.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Data Ibu</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--Data User-->
                <li class="{{ Route::is('admin.user.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.user.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data User</div>
                    </a>
                </li>


                <!--Laporan-->
                <li class="{{ Route::is('admin.laporan.index') ? $active : $nonActive }}">
                    <a href="{{ route('admin.laporan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-report"></i>

                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <!--Logout-->
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                        <i class="bx
                bx-power-off me-2"></i>
                        <span class="align-middle">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        @endif
    </aside>
    @push('scripts')
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="/sneat/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="/sneat/assets/vendor/libs/popper/popper.js"></script>
        <script src="/sneat/assets/vendor/js/bootstrap.js"></script>
        <script src="/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="/sneat/assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="/sneat/assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="/sneat/assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="/sneat/assets/js/dashboards-analytics.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    @endpush
