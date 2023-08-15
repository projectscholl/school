@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            <x-sidebar>
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <img src="image/stm_svg.svg.png" alt="" width="30px">
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
                            
                        @endslot
                        <a href="{{ route('murid.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Data Siswa</div>
                        </a>
                    </x-menu-item>


                    <!--Data Wali Murid-->
                    <x-menu-item>
                        @slot('active')
                        active open
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
                        <a href="#" class="menu-link">
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
                    <h5 class="card-header">Detail Wali Murid</h5>
                    <div class="card-body">
                        <div>ID : 1</div>
                        <hr>
                        <div>NAMA : {{ $user->name }}</div>
                        <hr>
                        <div>EMAIL : abraham@example.com</div>
                        <hr>
                        <div>Nomor Telepon : 09515964809651961 </div>
                        <hr>
                        <div>Dibuat : 2023-08-07 00:00:00 </div>
                        <hr>
                        <div>Di Update : 2023-08-07 00:00:00 </div>
                        <hr>


                        <h3 class="mt-4">Tambah Data Anak</h3>

                        <div class="form-group mb-3">
                            <label for="nama">Nama Anak</label>
                            <select name="wali" id="wali" class="form-control">
                                <option disabled selected>-----------</option>
                                <option value="">Suherman</option>
                                <option value="">Sutejo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>

                        <h3 class="mt-4">Data Anak</h3>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Suherman</td>
                                    <td>
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
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
