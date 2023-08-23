@extends('layouts.master')
@section('title', 'Create')
@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span>
                    Account
                </h4>

                <!--form-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Add New User</h5>
                            <div class="card-body">
                                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">User Name</label>
                                            <input
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                type="text" id="firstName" name="name" value="{{ old('name') }}"
                                                autofocus />
                                            @error('name')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="telepone" class="form-label">Telephone</label>
                                            <input
                                                class="form-control @error('telepon')
                                            is-invalid
                                        @enderror"
                                                type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" />
                                            @error('telepon')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input
                                                class="form-control @error('email')
                                            is-invalid
                                        @enderror"
                                                type="email" id="email" name="email"
                                                placeholder="john.doe@example.com" value="{{ old('email') }}" />
                                            @error('email')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3
                                                col-md-6">
                                            <label class="form-label" for="role">Role</label>
                                            <input class="form-control" type="text" id="" name="role"
                                                value="ADMIN" readonly="readonly" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input
                                                class="form-control @error('password')
                                            is-invalid
                                        @enderror"
                                                type="password" id="password" name="password" placeholder=""
                                                id="password" />
                                            @error('password')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="d-flex">
                                                <label>Show password</label>
                                                <input type="checkbox" id="checkbox" class="ms-2">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password_confirm" class="form-label">Password confirm</label>
                                            <input
                                                class="form-control @error('password_confirm')
                                            is-invalid
                                        @enderror"
                                                type="password" id="password_confirm" name="password_confirm"
                                                placeholder="" />
                                            @error('password_confirm')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6 d-flex flex-column">
                                            <label for="image" class="form-label">Image</label>
                                            <img src="" alt="" id="output" width="100"
                                                class="mb-3 rounded">
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image')
                                            is-invalid
                                        @enderror"
                                                value="{{ old('image') }}" onchange="loadFile(event)">
                                            @error('image')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2" id="success">Save
                                                changes</button>
                                            <a type="reset" class="btn btn-outline-secondary"
                                                href="{{ route('admin.user.index') }}">Cancel</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Form--->
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#checkbox').on('change', function() {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
            });
        });
    </script>
    <script>
        var loadFile = function(event) {

            var output = document.getElementById('output')
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
