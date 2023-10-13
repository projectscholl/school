@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                @if (session('edit'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('edit') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Kelas /</span>
                    Kelas
                </h4>
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary"><i
                                class='bx bx-add-to-queue'></i> Tambah kelas</a>
                        <a href="#" id="deleteAll" class="btn btn-danger ms-2">Delete Selected</a>

                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="d-flex"><input type="checkbox" id="select_all_ids" class="me-2"> Pilih
                                    </th>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Angkatan</th>
                                    <th>Jurusan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $index => $item)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $item->id }}" class="checksAll"
                                                name="ids"></td>
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->angkatans->tahun }}</td>
                                        <td>{{ $item->jurusans->nama }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.kelas.edit', $item->id) }}"
                                                class="btn btn-warning me-2"><i class='bx bx-edit-alt'></i></a>
                                            <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST">
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
    </div>
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
            toastr.error('{{ Session::get('pesan') }}')
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"
        integrity="sha512-mJQ9oQHzLM2zXe1cwiHmnMddNrmjv1YlaKZe1rM4J7q8JTnNn9UgeJVBV9jyV/lVGdXymVx6odhgwNZjQD8AqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js"
        integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
    <script>
        $(function(e) {
            $("#select_all_ids").click(function() {
                $('.checksAll').prop('checked', $(this).prop('checked'));
            });

            $("#deleteAll").click(function(e) {
                e.preventDefault();
                var all_ids = [];

                $('input:checkbox[name="ids"]:checked').each(function() {
                    all_ids.push($(this).val());
                });
                if ($('.checksAll').is(':checked')) {
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Kamu Akan Menghapus Biaya Yang dipilih!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iya,  Hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.kelas.delete') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    // Handle response jika diperlukan
                                    // Misalnya, menampilkan pesan sukses
                                    // Lakukan reload halaman setelah permintaan AJAX selesai
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    // Handle error jika diperlukan
                                    location.reload();
                                }

                            });
                        }
                    });
                }
                if (!$('.checksAll').is(':checked')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih Minimal 1!',
                    })
                }

            });
        });
    </script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: "Kamu Akan Menghapus Kelas!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Terhapus!',
                        'Kamu telah menghapus Kelas!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
