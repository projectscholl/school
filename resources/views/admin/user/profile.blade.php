@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->
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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile Settings</span>
                    Account
                </h4>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Profile details</h5>
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-4">
                                    <img src="{{ asset('storage/image/' . $user->image) }}" alt="" width="100"
                                        height="100" class="d-block rounded">
                                    <form id="{{ route('admin.profile.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="username" class="form-label">UserName</label>
                                                <input class="form-control" type="text" id="firstName" name="name"
                                                    value="{{ $user->name }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="telepon" class="form-label">Telephone</label>
                                                <input class="form-control" type="number" name="telepon" id="lastName"
                                                    value="{{ $user->telepon }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    value="{{ $user->email }}" placeholder="john.doe@example.com" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Role</label>
                                                <input class="form-control" type="text" id="email" name="role"
                                                    value="{{ $user->role }}" readonly />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="" class="form-label">Image</label>
                                                <input type="file" name="image" id="" class="form-control">
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
                    <!--/ Transactions -->
                </div>
                <!-- / Content -->
            </div>
        </div>
    </div>
    <!-- / Menu -->
@endsection
