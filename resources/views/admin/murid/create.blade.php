@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Sidebar -->

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <div class="card">
                    <h5 class="card-header">Tambah Murid</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.murid.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nama Wali</label>
                                <select name="id_users" id="id_users" class="form-control">
                                    <option disabled selected>-----------</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_users')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">NISN</label>
                                <input type="text" class="form-control" name="nisn" id="nisn"
                                    placeholder="Masukkan NISN" required>
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group mb-3">
                                    <label for="id_angkatans">Masukkan angkatan</label>
                                    <select name="id_angkatans" id="id_angkatans" class="form-control">
                                        <option value="">---------</option>
                                        @foreach ($angkatan as $data)
                                            <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_jurusans">Masukkan Jurusan</label>
                                    <select name="id_jurusans" id="id_jurusans" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kelas">Masukkan kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="form-control">

                                    </select>
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
                                </div>
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
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Jl.chicago" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
