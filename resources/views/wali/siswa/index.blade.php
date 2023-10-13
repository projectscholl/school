@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper ">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <div class="card">
                    <div class="d-flex align-items-center mt-3">
                        <h5 class="card-header">Data Siswa</h5>
                        <form action="{{ route('wali.siswa.index') }}" method="GET">
                                <div class="d-flex ms-5">
                                        <label for="id_angkatans"  class="ms-3">Masukkan Angkatan</label>
                                        <select name="id_angkatans" id="id_angkatans" class="form-control ms-3">
                                            <option value="">---------</option>
                                            @foreach ($angkatans as $data)
                                                <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                            @endforeach
                                        </select>

                                        <label for="id_jurusans" class="ms-3">Masukkan Jurusan</label>
                                        <select name="id_jurusans" id="id_jurusans" class="form-control ms-3">
                                            <option value="">---------</option>
                                        </select>
            
                                        <label for="id_kelas" class="ms-3">Masukkan Kelas</label>
                                        <select name="id_kelas" id="id_kelas" class="form-control ms-3">
                                            <option value="">---------</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary ms-3">Cari</button>

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
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NAMA</th>
                                    <th>ANGKATAN</th>
                                    <th>JURUSAN</th>
                                    <th>KELAS</th>
                                    {{-- <th>DETAIL</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($murids as $index => $item)
                                    <tr>
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>
                                                {{ $index + 1 }}
                                            </strong>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->angkatans->tahun }}</td>
                                        <td>{{ $item->jurusans->nama }}</td>
                                        <td>{{ $item->kelas->kelas }}</td>
                                            {{-- <strong>
                                                <a href="{{ route('admin.spp.pdf', ['id_murids' => $item->id]) }}"><i
                                                        class="menu-icon tf-icons bx bx-copy ms-2"></i>Cetak</a>
                                            </strong>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
    </div>
    </div>
@endsection
