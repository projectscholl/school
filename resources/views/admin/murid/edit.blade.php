@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            <x-sidebar>
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <img src="{{ asset('storage/image/stm_svg.svg.png') }}" alt="" width="30px">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize">TADIKA</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <!--Menu-->
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <x-menu-item>
                        @slot('active')
                        @endslot
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </x-menu-item>

                    <!-- Layouts -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Settings</span>
                    </li>

                    <!--Data User-->
                    <x-menu-item>
                        @slot('active')
                            <!---->
                        @endslot
                        <a href="{{ route('user.index') }}" class="menu-link active">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Data User</div>
                        </a>
                    </x-menu-item>

                    <!--Data Siswa-->
                    <x-menu-item>
                        @slot('active')
                            active open
                        @endslot
                        <a href="{{ route('murid.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Data Siswa</div>
                        </a>
                    </x-menu-item>


                    <!--Data Wali Murid-->
                    <x-menu-item>
                        @slot('active')
                            <!---->
                        @endslot
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Data Wali Murid</div>
                        </a>
                    </x-menu-item>

                    <!--Data Biaya-->
                    <x-menu-item>
                        @slot('active')
                        @endslot
                        <a href="{{ route('biaya.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Analytics">Data Biaya</div>
                        </a>
                    </x-menu-item>

                    <!--Account setting-->
                    <x-menu-dropdown>
                        @slot('active')
                            {{-- nonactive --}}
                        @endslot
                        @slot('slot1')
                            Account settings
                        @endslot

                        <!--Dropdown list-->
                        @slot('slot2')
                            <li class="menu-item">
                                <a href="{{ route('user.profile') }}" class="menu-link">
                                    <div data-i18n="Without menu">Profile</div>
                                </a>
                            </li>
                        @endslot
                    </x-menu-dropdown>

                    <!-- Layouts -->

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">DATA TRANSAKSI</span>
                    </li>

                    <!--Data Tagihan-->
                    <x-menu-item>
                        @slot('active')
                            <!---->
                        @endslot
                        <a href="{{ route('tagihan.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Analytics">Data Tagihan</div>
                        </a>
                    </x-menu-item>

                    <!--Data Pembayaran-->
                    <x-menu-item>
                        @slot('active')
                            <!---->
                        @endslot
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Analytics">Data Pembayaran</div>
                        </a>
                    </x-menu-item>



                    <!--Account setting-->
                    <x-menu-dropdown>
                        @slot('active')
                            {{-- nonactive --}}
                        @endslot
                        @slot('slot1')
                            Account settings
                        @endslot

                        <!--Dropdown list-->
                        @slot('slot2')
                            <li class="menu-item">
                                <a href="{{ route('user.profile') }}" class="menu-link">
                                    <div data-i18n="Without menu">Profile</div>
                                </a>
                            </li>
                        @endslot
                    </x-menu-dropdown>
                </ul>
            </x-sidebar>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-navbar></x-navbar>
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bordered Table -->
                        <div class="card">
                            <h5 class="card-header">Edit Murid</h5>
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            placeholder="Masukkan Nama">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama Wali</label>
                                        <select name="wali" id="wali" class="form-control">
                                            <option disabled selected>-----------</option>
                                            <option value="">Asep</option>
                                            <option value="">Rahman</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="content">Jurusan</label>
                                        <select name="jurusan" id="jurusan" class="form-control">
                                            <option disabled selected>-----------</option>
                                            <option value="">RPL</option>
                                            <option value="">Multimedia</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="content">Kelas</label>
                                        <input type="number" class="form-control" name="kelas" id="kelas">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ Bordered Table -->
                </div>
            </div>
        </div>
    </div>
@endsection
