@extends('layouts.master')

@section('title', 'Profile')
@section('content')
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <!-- Content wrapper -->
        <div class="content-wrapper">

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile Settings /</span>
                    Profile
                </h4>
                <div class="row">
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
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="telepon" class="form-label">Telephone</label>
                                                <input class="form-control" type="number" name="telepon" id="lastName"
                                                    value="{{ str_replace('62', '0', $user->telepon) }}" />
                                                @error('telepon')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    value="{{ $user->email }}" placeholder="john.doe@example.com" />
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Role</label>
                                                <input class="form-control" type="text" id="email" name="role"
                                                    value="{{ $user->role }}" readonly />
                                                @error('role')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="old_password" class="form-label">Old Password</label>
                                                <input class="form-control" type="password" id=""
                                                    name="old_password" placeholder="****" />
                                                @error('old_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="password" class="form-label">New Password</label>
                                                <input class="form-control" type="password" id="email" name="password"
                                                    placeholder="****" />
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="old_password" class="form-label">Password Confirmation</label>
                                                <input class="form-control" type="password" id="email"
                                                    name="password_confirmation" placeholder="****" />
                                                @error('password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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
