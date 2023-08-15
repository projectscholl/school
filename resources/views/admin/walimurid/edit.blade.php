@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
        @include('layouts.sidebar')

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
                                <form action="">
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="content">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Alamat Email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="content">Telepon</label>
                                        <input type="number" class="form-control" name="telephone" id="telephone" placeholder="Masukkan nomor telepon">
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
