@extends('layouts.master')

@section('title', 'Edit')
@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span>
                    {{ $user->name }}
                </h4>

                <!--Form-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Edit User</h5>
                            <div class="card-body">
                                <form id="formAccountSettings" method="POST" onsubmit="return false"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="username" class="form-label">User Name</label>
                                            <input class="form-control" type="text" id="firstName" name="firstName"
                                                value="{{ $user->name }}" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="telepone" class="form-label">Telephone</label>
                                            <input class="form-control" type="text" name="telepone" id="lastName"
                                                value="{{ $user->telepon }}" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                placeholder="john.doe@example.com" value="{{ $user->email }}" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="country">Role</label>
                                            <input class="form-control" type="text" id="" name="role"
                                                value="ADMIN" disabled />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Password</label>
                                            <input class="form-control" type="text" id="password" name="password"
                                                placeholder="" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Password confirm</label>
                                            <input class="form-control" type="text" id="password_confirm"
                                                name="password_confirm" placeholder="" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="" class="form-label">Image</label>
                                            <input type="file" name="image" id="" class="form-control">
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save
                                                changes</button>
                                            <a type="reset" class="btn btn-outline-secondary"
                                                href="{{ route('admin.user.index') }}">Cancel</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Form-->
            </div>
        </div>
    </div>
@endsection
