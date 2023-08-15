@extends('layouts.master')

@section('title', 'Edit')
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
                    Bank Account
                </h4>
                <div class="row">
                    <div class="col-md-12">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
