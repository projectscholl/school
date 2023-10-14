@extends('layouts.master')

@section('title', 'Ayah')
@section('content')
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Ayah Murid /</span>
                    Ayah Murid
                </h4>
                <!-- Bordered Table -->

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <a href="{{ route('admin.AyahMurid.create') }}"
                                class="btn btn-primary d-flex align-items-center"><i class='bx bx-add-to-queue me-1'></i>
                                Tambah
                                Data</a>
                            <a href="#" id="deleteAll" class="btn btn-danger ms-2 d-flex align-items-center"><i
                                    class='bx bx-trash me-1'></i> Delete
                                Selected</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive text-wrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="d-flex"><input type="checkbox" id="select_all_ids" class="me-2">
                                            Pilih
                                        </th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ayah as $key => $ayahs)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $ayahs->id }}" class="checksAll"
                                                    name="ids"></td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ayahs->name }}</td>
                                            <td>{{ $ayahs->pekerjaan }}</td>
                                            <td><a href="{{ route('admin.AyahMurid.status', $ayahs->id) }}"
                                                    class="btn btn-{{ $ayahs->status ? 'success' : 'danger' }}">{{ $ayahs->status ? 'Aktif' : 'Non Afktif' }}</a>
                                            </td>
                                            <td class="d-flex">

                                                <a href="{{ route('admin.AyahMurid.show', $ayahs->id) }}"
                                                    class="btn ms-2 btn-primary"><i class="bx bx-detail"></i></a>
                                                <a href="{{ route('admin.AyahMurid.edit', $ayahs->id) }}"
                                                    class="btn ms-2 btn-warning"><i class="bx bx-edit-alt"></i></a>
                                                <form action="{{ route('admin.AyahMurid.destroy', $ayahs->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger ms-2"><i class="bx bx-trash"></i></button>
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
                                url: "{{ route('admin.AyahMurid.delete') }}",
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
                                    console.error(xhr.responseText);
                                }

                            });
                            Swal.fire(
                                'Terhapus!',
                                'Kamu telah menghapus Biaya!!.',
                                'success'
                            )
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
                text: "Kamu Akan Menghapus Biaya!!",
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
                        'Kamu telah menghapus Biaya!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
