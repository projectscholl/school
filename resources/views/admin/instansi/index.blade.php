@extends('layouts.master')

@section('title', 'Instansi')
@section('content')
    @include('layouts.sidebar')
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
                        <div class="card mb-3">
                            <div class="card-header">Instansi</div>
                            <div class="card-body">
                                <div class="">
                                    <img src="{{ asset('storage/image/tutwuri1.png') }}" alt="" width="100"
                                        height="100" class="d-block rounded">
                                    <form id="formAccountSettings" method="POST" onsubmit="return false"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="logo" class="form-label">Logo</label>
                                                <input class="form-control" type="file" id="firstName" name="logo"
                                                    autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="telepone" class="form-label">Telephone</label>
                                                <input class="form-control" type="text" name="lastName" id="lastName" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    placeholder="john.doe@example.com" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Alamat</label>
                                                <input class="form-control" type="text" id="alamat" name="text"
                                                    placeholder="Jl.Manggur" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="" class="form-label">Tanda Tangan</label>
                                                <input type="file" name="" id="" class="form-control">
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
                    <div class="card mt-4">
                        <div class="card-header">Bank Account</div>
                        <div class="card-body">
                            <div class="">
                                <form id="formAccountSettings" method="POST" onsubmit="return false"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="logo" class="form-label">Nama</label>
                                            <input class="form-control" type="text" id="firstName" name="logo"
                                                autofocus value="ASEP" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="logo" class="form-label">No Rekening</label>
                                            <input class="form-control" type="number" id="firstName" name="logo"
                                                autofocus value="8976544323" />
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        </div>
                                </form>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No rekening</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>ASEP</td>
                                            <td>8976544323</td>
                                            <td class="d-flex">
                                                <a href="" class="btn btn-warning me-2">Edit</a>
                                                <form action="" class="">
                                                    <button class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
