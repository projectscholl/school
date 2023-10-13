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
                    <h5 class="card-header">Edit Wali Murid</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.walimurid.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name" class="mb-3">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama" required value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="mb-3">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Masukkan Alamat Email" required value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="sebagai" class="mb-3">Sebagai</label>
                                <input type="text" class="form-control" name="hubungan" id="sebagai"
                                    placeholder="Ibu,Ayah,Paman,Bibi,Kakak,Adik"
                                    value="{{ old('hubungan', $user->hubungan) }}">
                                @error('hubungan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="mb-3">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Masukkan Password Baru">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="checkbox" onclick="togglePasswordVisibility()">
                                <label for="show_password" class="mb-3">Show Password</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb</p>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="mb-3">Telepon</label>
                                <input type="number" class="form-control" name="telepon" id="telepon"
                                    placeholder="Masukkan nomor telepon" required
                                    value="{{ old('telepon', str_replace('62', '0', $user->telepon)) }}">
                                @error('telepon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function togglePasswordVisibility() {
                    var passwordInput = document.getElementById("password");
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                    } else {
                        passwordInput.type = "password";
                    }
                }
            </script>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
