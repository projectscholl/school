@extends('layouts.master')

@section('title', 'User')
@section('content')

    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">User Admin Tables</h5>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary col-2 ms-4">Tambah User</a>
                    <div class="card-body">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- Bordered Table -->
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>No Telephone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user1 as $index => $item)
                                            <tr>
                                                <td>
                                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $index + 1 }}</strong>
                                                </td>
                                                <td>
                                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td>{{ $item->role }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td class="d-flex">

                                                    <a href="{{ route('admin.user.edit', $item->id) }}"
                                                        class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i></a>
                                                    <form action="{{ route('admin.user.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger show_confirm" id=""
                                                            type="submit"><i class="bx bx-trash"></i></button>
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
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection

@push('scripts')
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
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
