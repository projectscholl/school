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
                                <label for="content">Nama Ayah</label>
                                <select name="id_ayah" id="id_users" class="form-control">
                                    <option disabled selected>-----------</option>
                                    @foreach ($ayah as $ayahs)
                                        <option value="{{ $ayahs->id }}">{{ $ayahs->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_ayah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nama Ibu</label>
                                <select name="id_ibu" id="id_ibu" class="form-control">
                                    <option disabled selected>-----------</option>
                                    @foreach ($ibu as $ibus)
                                        <option value="{{ $ibus->id }}">{{ $ibus->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_ibu')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">NISN</label>
                                <input type="text" class="form-control mb-3" name="nisn" id="nisn"
                                    placeholder="Masukkan NISN" required>
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Masukkan Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                                @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Masukkan Agama</label>
                                <select name="agama" id="" class="form-control">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Ateis">Ateis</option>
                                </select>
                                @error('agama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Jenis Kelamin</label>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <input type="radio" name="jenis_kelamin" id="laki" value="laki-laki">
                                        <label for="">Laki-laki</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="jenis_kelamin" id="perempuan" value="perempuan">
                                        <label for="">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control">
                                    <option value="">--Pilih---</option>
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
                                        if (jurusanGrouped[angkatanId]) {
                                            jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';
                                        } else {
                                            jurusanSelect.innerHTML =
                                                '<option value="">Data Jurusan Kosong : Silahkan buat data jurusan terlebih dahulu !</option>';
                                        }

                                        jurusanOptions.forEach(jurusan => {
                                            const option = document.createElement('option');
                                            option.value = jurusan.id;
                                            option.textContent = jurusan.nama;
                                            jurusanSelect.appendChild(option);
                                        });

                                        updateKelasOptions();
                                    });

                                    jurusanSelect.addEventListener('change', () => {

                                        const jurusanId = jurusanSelect.value;
                                        const kelasOptions = kelasGrouped[jurusanId] || [];

                                        if (kelasGrouped[jurusanId]) {
                                            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';
                                        } else {
                                            kelasSelect.innerHTML =
                                                '<option value="">Data Kelas Kosong : Silahkan buat data kelas terlebih dahulu !</option>';
                                        }

                                        kelasOptions.forEach(kelas => {
                                            const option = document.createElement('option');
                                            option.value = kelas.id;
                                            option.textContent = kelas.kelas;
                                            kelasSelect.appendChild(option);
                                        });
                                        updateKelasOptions();
                                    });
                                </script>
                            </div>
                            {{-- <script>
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
                            </script> --}}
                            <div class="form-group mb-3">
                                <label for="nama">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Jl.chicago" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
