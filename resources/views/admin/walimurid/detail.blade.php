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
                        <div>NAMA : {{ $user->name }} </div>
                        <hr>
                        <div>EMAIL : {{ $user->email }} </div>
                        <hr>
                        <div>Nomor Telepon :  {{ $user->telepon }}</div>
                        <hr>
                        <div>Dibuat : {{ $user->created_at }} </div>
                        <hr>
                        <div>Di Update :  {{ $user->updated_at }}</div>
                        <hr>

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
                                @foreach ($user->murid as $index => $anak)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $anak->name }}</td> 
                                        <td>
                                            <form action="">
                                                <button class="btn btn-danger"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
