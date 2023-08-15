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
