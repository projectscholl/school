@extends('layouts.master')

@section('title', 'User')
@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            {{-- Sweetalert if error exist --}}
            @if (session('success'))
                <div>{{ session('success') }}</div>
            @endif
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">User Admin Tables</h5>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary col-2 ms-4">Tambah User</a>
                    <div class="card-body">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <!-- Bordered Table -->
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>No Telephone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user1 as $index => $item)
                                            <tr>
                                                <td>
                                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $index + 1 }}</strong>
                                                </td>
                                                <td>
                                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td>{{ $item->role }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td class="d-flex">

                                                    <a href="{{ route('admin.user.edit', $item->id) }}"
                                                        class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i></a>
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
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>


@endsection
