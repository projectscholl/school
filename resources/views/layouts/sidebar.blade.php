    <!-- Sidebar -->

    @php
        $active = 'menu-item active';
        $nonActive = 'menu-item';
    @endphp
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
        <div class="app-brand demo mb-3 ">
            <a class="app-brand-link" href="{{ route('welcome') }}">

                <img src="{{ asset('/storage/image/' . $instansi->logo) }}" alt="" width="30px">
                <span class="demo menu-text fw-bolder ms-2 fs-3">{{ $instansi->name }}</span>
            </a>

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


                <li class="{{ Route::is('admin.biaya.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.biaya.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                        <div data-i18n="Without menu">Data biaya</div>
                    </a>
                </li>
                <!--Data Pembayaran-->
                <li class="{{ Route::is('admin.pembayaran', 'admin.pembayaran.detail') ? $active : $nonActive }}">
                    <a href="{{ route('admin.pembayaran') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-credit-card-front"></i>

                        <div data-i18n="Without menu">Data Pembayaran</div>
                    </a>
                </li>
                <!--Laporan-->
                <li class="{{ Route::is('admin.laporan.index') ? $active : $nonActive }}">
                    <a href="{{ route('admin.laporan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-report"></i>

                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <!-- Layouts -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">SETTING USER</span>
                </li>

                <!--Data User-->
                <li class="{{ Route::is('admin.user.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.user.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data User</div>
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

                <!--Data Siswa-->
                <li class="{{ Route::is('admin.murid.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.murid.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data Siswa</div>
                    </a>
                </li>

                <!--Data Wali Murid-->
                <li class="{{ Route::is('admin.walimurid.*') ? $active : $nonActive }}">
                    <a href="{{ route('admin.walimurid.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Data Wali Murid</div>
                    </a>
                </li>
                <!--Account setting-->
                <li
                    class="menu-item {{ Route::is('admin.profile.*', 'admin.instansi.*', 'admin.bank.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="Account Settings">Account Setting</div>
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
