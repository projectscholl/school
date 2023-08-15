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
                            <h5 class="card-header">Edit Wali Murid</h5>
                            <div class="card-body">
                                <form action="{{ route('admin.walimurid.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="name" class="mb-3">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Masukkan Nama" required value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="content" class="mb-3">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Masukkan Alamat Email" required value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="mb-3">Password Baru</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukkan Password Baru">
                                        <p class="text-muted mb-0">Kosongkan jika tidak ingin mengganti password</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb</p>
                                    </div>                            
                                    <div class="form-group mb-3">
                                        <label for="content" class="mb-3">Telepon</label>
                                        <input type="number" class="form-control" name="telepon" id="telepon"
                                            placeholder="Masukkan nomor telepon" required value="{{ old('telepon' , $user->telepon) }}">
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
