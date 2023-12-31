@extends('layouts.master')

@section('title', 'Instansi')
@section('content')
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar>
        </x-navbar>
        <!-- Content wrapper -->
        <div class="content-wrapper">

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Instansi Settings /</span>
                    Account
                </h4>
                <div class="row">
                    <div class="col-md-12">
                        @if (session('pesan'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('pesan') }}!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card mb-3">
                            <div class="card-header">Instansi</div>
                            <div class="card-body">
                                <div class="">
                                    <img src="{{ asset('storage/image/' . $instansi->logo) }}" alt="" width="100"
                                        height="100" class="d-block rounded">
                                    <form id="formAccountSettings"
                                        action="{{ route('admin.instansi.update', $instansi->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="logo" class="form-label">Logo</label>
                                                <input class="form-control" type="file" id="firstName" name="logo"
                                                    autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="logo" class="form-label">Nama Instansi</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    value="{{ old('name', $instansi->name) }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="telepone" class="form-label">Telephone</label>
                                                <input class="form-control" type="text" name="telepon" id="telepon"
                                                    value="{{ old('telepon', $instansi->telepon) }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    placeholder="john.doe@example.com"
                                                    value="{{ old('email', $instansi->email) }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Alamat</label>
                                                <input class="form-control" type="text" id="alamat" name="alamat"
                                                    placeholder="Jl.Manggur"
                                                    value="{{ old('alamat', $instansi->alamat) }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="" class="form-label">Tanda Tangan</label>
                                                <img src="{{ asset('storage/image/' . $instansi->tanda_tangan) }}"
                                                    alt="" width="100" height="100" class="d-block rounded">
                                                <input type="file" name="tanda_tangan" id="tanda_tangan"
                                                    class="form-control mt-2">
                                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of
                                                    800K
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card mt-4">
                        <div class="card-header">Bank Account</div>
                        <div class="card-body">
                            <div class="">
                                <form id="formAccountSettings" action="{{ route('admin.instansi.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="logo" class="form-label">Nama</label>
                                            <input class="form-control" type="text" id="nama" name="nama"
                                                autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="logo" class="form-label">No Rekening</label>
                                            <input class="form-control" type="number" id="no_rekening"
                                                name="no_rekening" autofocus />
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        </div>
                                </form>
                                <div class="table-responsive text-nowrap">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>No rekening</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banks as $bank)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $bank->nama }}</td>
                                                    <td>{{ $bank->no_rekening }}</td>
                                                    <td class="d-flex">
                                                        <form action="{{ route('admin.instansi.destroy', $bank->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger show_confirm">Delete</button>
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
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @elseif (Session::has('pesan'))
            toastr.success('{{ Session::get('pesan') }}')
        @endif
    </script>
@endpush
