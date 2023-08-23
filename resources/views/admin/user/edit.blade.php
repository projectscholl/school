@extends('layouts.master')

@section('title', 'Edit')
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
                    {{ $user->name }}
                </h4>

                <!--Form-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Edit User</h5>
                            @if (session('success'))
                                <div>{{ session('success') }}</div>
                            @endif
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.user.update', $user->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="username" class="form-label">User Name</label>
                                            <input
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                type="text" name="name" value="{{ $user->name }}" autofocus />
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
                                                type="number" name="telepon" value="{{ $user->telepon }}" />
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
                                                placeholder="john.doe@example.com" value="{{ $user->email }}" />
                                            @error('email')
                                                <div id="validationServer05Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="country">Role</label>
                                            <input class="form-control" type="text" id="" name="role"
                                                value="ADMIN" readonly />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input
                                                class="form-control @error('current_password')
                                                is-invalid
                                            @enderror"
                                                type="password" id="password" name="password" placeholder="" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="new_password" class="form-label">Password Confirm</label>
                                            <input
                                                class="form-control @error('password_confirmation')
                                                is-invalid
                                            @enderror"
                                                type="password" id="password_confirmation" name="password_confirmation"
                                                placeholder="" />
                                        </div>
                                        <div class="mb-3 col-md-6 d-flex flex-column">
                                            <label for="" class="form-label">Image</label>
                                            <img src="{{ asset('storage/image/' . $user->image) }}" alt=""
                                                width="100" class="mb-3 rounded" id="output">
                                            <input type="file" name="image"
                                                class="form-control @error('image')
                                                is-invalid
                                            @enderror"
                                                onchange="loadFile(event)">
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG.
                                                Max size of 2Mb
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
@push('scripts')
    <script>
        var loadFile = function(event) {

            var output = document.getElementById('output')
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
