@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->


    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar>
        </x-navbar>
        <!-- Content wrapper -->
        <div class="content-wrapper">

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile Settings /</span>
                    Profile
                </h4>
                <div class="row">
                    @if (session('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Profile details</h5>
                            <div class="card-body">
                                <img src="{{ asset('storage/image/' . $user->image) }}" alt="" width="100"
                                    height="100" class="d-block rounded mb-3">
                                <div class="d-flex align-items-start gap-4">
                                    <form action="{{ route('admin.profile.update', $user->id) }}" id="formId"
                                        method="POST" enctype="multipart/form-data">
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
                                                <label for="old_password" class="form-label">Old Password</label>
                                                <input class="form-control" type="password" id=""
                                                    name="old_password" placeholder="****" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="password" class="form-label">New Password</label>
                                                <input class="form-control" type="password" id="email" name="password"
                                                    placeholder="****" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="old_password" class="form-label">Password Confirmation</label>
                                                <input class="form-control" type="password" id="email"
                                                    name="password_confirmation" placeholder="****" />Settings
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="" class="form-label">Image</label>
                                                <input type="file" name="image" id="" class="form-control">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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

@push('scripts')
    <script type="text/javascript">
        var someForm = document.getElementById('formId');
        someForm.setAttribute("autocomplete", "off");
    </script>
@endpush
