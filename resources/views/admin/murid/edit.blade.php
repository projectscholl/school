@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            @if ($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <div class="card">
                    <h5 class="card-header">Edit Murid</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.murid.update', ['murid' => $murid->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama" value="{{ $murid->name }}" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nama Wali</label>
                                <select name="id_users" id="id_users" class="form-control">
                                    <option disabled selected>-----------</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $murid->id_users == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
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
                                        <option value="{{ $ayahs->id }}"
                                            {{ $murid->id_ayah == $ayahs->id ? 'selected' : '' }}>{{ $ayahs->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_ayah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nama Ibu</label>
                                <select name="id_ibu" id="id_ibu" class="form-control">
                                    <option disabled selected>--Pilih---</option>
                                    @foreach ($ibu as $ibus)
                                        <option value="{{ $ibus->id }}"
                                            {{ $murid->id_ibu == $ibus->id ? 'selected' : '' }}>{{ $ibus->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_ibu')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">NISN</label>
                                <input type="text" class="form-control mb-3" name="nisn" id="nisn"
                                    placeholder="Masukkan NISN" value="{{ $murid->nisn }}" required>
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Masukkan Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ $murid->tanggal_lahir }}">
                                @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Masukkan Agama</label>
                                <select name="agama" id="" class="form-control">
                                    <option value="Islam" {{ $murid->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ $murid->agama == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Katolik" {{ $murid->agama == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu" {{ $murid->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ $murid->agama == 'Buddha' ? 'selected' : '' }}>Buddha
                                    </option>
                                    <option value="Konghucu" {{ $murid->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                    </option>
                                    <option value="Ateis" {{ $murid->agama == 'Ateis' ? 'selected' : '' }}>Ateis</option>
                                </select>
                                @error('agama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Jenis Kelamin</label>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <input type="radio" name="jenis_kelamin" id="laki" value="laki-laki"
                                            {{ $murid->jenis_kelamin == 'laki-laki' ? 'checked' : '' }}>
                                        <label for="">Laki-laki</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="jenis_kelamin" id="perempuan" value="perempuan"
                                            {{ $murid->jenis_kelamin == 'perempuan' ? 'checked' : '' }}>
                                        <label for="">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}"
                                            {{ old('id_angkatans', $murid->id_angkatans) == $data->id ? 'selected' : '' }}>
                                            {{ $data->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans"
                                    class="form-control @error('id_jurusans') is-invalid @enderror jurusans">
                                </select>
                                @error('id_jurusans')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kelas">Masukkan kelas</label>
                                <select name="id_kelas" id="id_kelas"
                                    class="form-control @error('id_kelas') is-invalid @enderror">
                                </select>
                                @error('id_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <script>
                                    const angkatanSelect = document.getElementById('id_angkatans');
                                    const jurusanSelect = document.getElementById('id_jurusans');
                                    const kelasSelect = document.getElementById('id_kelas');
                                    const jurusanS = document.querySelector('.jurusans');


                                    const jurusanGrouped = @json($jurusanGrouped);
                                    const kelasGrouped = @json($kelasGrouped);
                                    const jurusansId = @json($murid->id_jurusans);
                                    const kelasId = @json($murid->id_kelas);


                                    //INI YANG JURUSAN SELECT

                                    const angkatanId = angkatanSelect.value;
                                    const jurusanOptions = jurusanGrouped[angkatanId] || [];

                                    jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';

                                    jurusanOptions.forEach(jurusan => {
                                        const option = document.createElement('option');
                                        option.value = jurusan.id;
                                        option.textContent = jurusan.nama;
                                        if (jurusansId == jurusan.id) {
                                            option.selected = true;
                                        }
                                        jurusanSelect.appendChild(option);
                                    });
                                    //INI YANG KELAS SELECT
                                    const jurusanId = jurusanSelect.value;
                                    const kelasOptions = kelasGrouped[jurusanId] || [];

                                    kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

                                    kelasOptions.forEach(kelas => {
                                        const option = document.createElement('option');
                                        option.value = kelas.id;
                                        option.textContent = kelas.kelas;
                                        if (kelasId == kelas.id) {
                                            option.selected = true;
                                        }
                                        kelasSelect.appendChild(option);
                                    });



                                    angkatanSelect.addEventListener('change', () => {
                                        const angkatanId = angkatanSelect.value;
                                        const jurusanOptions = jurusanGrouped[angkatanId] || [];

                                        jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';

                                        jurusanOptions.forEach(jurusan => {
                                            const option = document.createElement('option');
                                            option.value = jurusan.id;
                                            option.textContent = jurusan.nama;
                                            jurusanS.appendChild(option);
                                        });

                                    });

                                    jurusanSelect.addEventListener('change', () => {
                                        const jurusanId = jurusanSelect.value;
                                        const kelasOptions = kelasGrouped[jurusanId] || [];

                                        kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

                                        kelasOptions.forEach(kelas => {
                                            const option = document.createElement('option');
                                            option.value = kelas.id;
                                            option.textContent = kelas.kelas;
                                            kelasSelect.appendChild(option);
                                        });
                                    });
                                </script>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Jl.chicago" value="{{ $murid->address }}" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <!--/ Bordered Table -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
