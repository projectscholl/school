@extends('layouts.master')

@section('title', 'Biaya')
@section('content')
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Biaya / </span>
                    Biaya
                </h4>
                <!-- Bordered Table -->
                <div class="card">
                    <div class="card-header d-xl-block">
                        <div class="d-xl-flex align-items-center mb-4 d-block">
                            <a href="{{ route('admin.biaya.create') }}" class="btn btn-primary"><i
                                    class='bx bx-add-to-queue'></i> Add Data</a>
                            <a href="#" id="deleteAll" class="btn btn-danger ms-2 text-center"><i
                                    class='bx bx-trash me-1'></i>
                                Delete Selected</a>
                        </div>
                        <form action="{{ route('admin.biaya.index') }}" method="GET">
                            <div class="d-xl-flex align-items-center d-sm-block col-xl-12 col-10">
                                <label for="id_angkatans" class="ms-3">Pilih Angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control ms-3">
                                    <option value="">---------</option>
                                    @foreach ($angkatans as $data)
                                        <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                    @endforeach
                                </select>

                                <label for="id_jurusans" class="ms-3">Pilih Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans" class="form-control ms-3">
                                    <option value="">---------</option>
                                </select>

                                <label for="id_kelas" class="ms-3">Pilih Kelas</label>
                                <select name="id_kelas" id="id_kelas" class="form-control ms-3">
                                    <option value="">---------</option>
                                </select>


                                <button type="submit" class="btn btn-primary mt-xl-0 mt-3 ms-3  ">Cari</button>
                            </div>
                        </form>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="d-flex"><input type="checkbox" id="select_all_ids" class="me-2">
                                            Pilih
                                        </th>
                                        <th>No</th>
                                        <th>Nama Biaya</th>
                                        <th>tahun</th>
                                        <th>jurusan</th>
                                        <th>kelas</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($biayaAll as $key => $value)
                                        <tr id="value_ids" {{ $value->id }}>
                                            <td><input type="checkbox" name="ids" id=""
                                                    value="{{ $value->id }}" class="checksAll"></td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->nama_biaya }}</td>
                                            <td>{{ $value->angkatans->tahun }}</td>
                                            <td>{{ $value->jurusans->nama }}</td>
                                            <td>{{ $value->kelas->kelas }}</td>
                                            <td class="d-flex">

                                                <a href="{{ route('admin.biaya.edit', $value->id) }}"
                                                    class="btn btn-warning me-2"><i class="bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.biaya.destroy', $value->id) }}"
                                                    method="POST">
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
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const angkatanSelect = document.getElementById('id_angkatans');
        const jurusanSelect = document.getElementById('id_jurusans');
        const kelasSelect = document.getElementById('id_kelas');

        const jurusanGrouped = @json($jurusanGrouped);
        const kelasGrouped = @json($kelasGrouped);

        angkatanSelect.addEventListener('change', () => {
            const angkatanId = angkatanSelect.value;
            const jurusanOptions = jurusanGrouped[angkatanId] || [];

            jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';

            jurusanOptions.forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan.id;
                option.textContent = jurusan.nama;
                jurusanSelect.appendChild(option);
            });

            updateKelasOptions();
        });

        jurusanSelect.addEventListener('change', () => {
            updateKelasOptions();
        });

        function updateKelasOptions() {
            const jurusanId = jurusanSelect.value;
            const kelasOptions = kelasGrouped[jurusanId] || [];

            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

            kelasOptions.forEach(kelas => {
                const option = document.createElement('option');
                option.value = kelas.id;
                option.textContent = kelas.kelas;
                kelasSelect.appendChild(option);
            });
        }
    </script>
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
        const angkatanSelect = document.getElementById('id_angkatans');
        const jurusanSelect = document.getElementById('id_jurusans');
        const kelasSelect = document.getElementById('id_kelas');

        const jurusanGrouped = @json($jurusanGrouped);
        const kelasGrouped = @json($kelasGrouped);

        angkatanSelect.addEventListener('change', () => {
            const angkatanId = angkatanSelect.value;
            const jurusanOptions = jurusanGrouped[angkatanId] || [];

            jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';

            jurusanOptions.forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan.id;
                option.textContent = jurusan.nama;
                jurusanSelect.appendChild(option);
            });

            updateKelasOptions();
        });

        jurusanSelect.addEventListener('change', () => {
            updateKelasOptions();
        });

        function updateKelasOptions() {
            const jurusanId = jurusanSelect.value;
            const kelasOptions = kelasGrouped[jurusanId] || [];

            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

            kelasOptions.forEach(kelas => {
                const option = document.createElement('option');
                option.value = kelas.id;
                option.textContent = kelas.kelas;
                kelasSelect.appendChild(option);
            });
        }
    </script>
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
                                url: "{{ route('admin.biaya.delete') }}",
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
