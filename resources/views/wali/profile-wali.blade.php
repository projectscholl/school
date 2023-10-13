@extends('layouts.master')

@section('title', 'Profile')
@section('content')
    <!-- Layout wrapper -->

    <!-- / Sidebar -->

    <!-- Layout container -->
    <div class="layout-page">

        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    @if (session('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Profile</h5>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('storage/image/' . $user->image) }}" alt="" width="100"
                                    height="100" class="d-block rounded mb-3">
                                <div class="d-flex align-items-start gap-4">
                                    <form action="{{ route('profile.update', $user->id) }}" id="" method="POST" enctype="multipart/form-data">
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
                                                    value="{{ $user->role }}" readonly/>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="old_password" class="form-label">Old Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="password" id="password" name="old_password" placeholder="****"/>
                                                    <button type="button" class="btn btn-outline-secondary" id="showOldPassword"><i class='bx bx-low-vision'></i>   </button>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="old_password" class="form-label">Password Confirmation</label>
                                                <input class="form-control" type="password" id="email"
                                                    name="password_confirmation" placeholder="****" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="password" class="form-label">New Password</label>
                                                <input class="form-control" type="password" id="email" name="password"
                                                    placeholder="****" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="" class="form-label">Image</label>
                                                <input type="file" name="image" id="" class="form-control">
                                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of
                                                    800K
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2 show_confirm">Save changes</button>
                                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const oldPasswordInput = document.getElementById('password');
        const showOldPasswordButton = document.getElementById('showOldPassword');
        
        showOldPasswordButton.addEventListener('click', function () {
            if (oldPasswordInput.type === 'password') {
                oldPasswordInput.type = 'text';
            } else {
                oldPasswordInput.type = 'password';
            }
        });
    </script>
    <script>
        var confirmButton = document.getElementById('confirmButton');
    
    
        confirmButton.addEventListener('click', function() {
            confirmButton.style.display = 'none';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"
        integrity="sha512-mJQ9oQHzLM2zXe1cwiHmnMddNrmjv1YlaKZe1rM4J7q8JTnNn9UgeJVBV9jyV/lVGdXymVx6odhgwNZjQD8AqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js"
        integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Ubah?',
                text: "Kamu Akan Mengubah Data Walimurid!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Terubah!',
                        'Kamu telah Mengubah Data Walimurid!!.',
                        'success'
                    )
                }
            });
        });
    </script>

@endsection
