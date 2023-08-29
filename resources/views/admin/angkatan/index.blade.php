@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <div class="card">
                    @if (session('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('pesan'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('pesan') }}!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="card-header">Angkatan Tables</h5>
                    <a href="{{ route('admin.angkatan.create') }}" class="btn btn-primary col-2 ms-4">Tambah Angkatan</a>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($angkatan as $index => $item)
                                        <tr>
                                            <td>
                                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>
                                                    {{ $index + 1 }}
                                                </strong>
                                            </td>
                                            <td>
                                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $item->tahun ?? 'Tidak ada Angkatan' }}</strong>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.angkatan.edit', $item->id) }}"
                                                    class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.angkatan.destroy' ,$item->id) }}"method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger show_confirm" type="submit"><i
                                                        class="bx bx-trash"></i></button>
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
                title: 'Yakin?',
                text: "Kamu Akan Menghapus Angkatan beserta Jurusan dan Kelas yang ada di alamnya!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya,  Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Terhapus!',
                        'Kamu telah menghapus Angkatan!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush