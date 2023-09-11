@extends('layouts.master')

@section('title', 'Laporan')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Laporan Pembayaran</h4>
                        <div class="pe-5 me-5">
                            <form action="">
                                <label for="" class="mb-2">Pilih Tahun Laporan</label>
                                <select name="" id="" class="form-control">
                                    <option value="">2021</option>
                                    <option value="">2022</option>
                                    <option value="">2023</option>
                                    <option value="">2024</option>
                                </select>
                                <button type="submit"
                                    class="d-flex align-items-center justify-content-around px-5 btn btn-primary mt-3 col-md-2">
                                    <i class='bx bx-book-content'></i>
                                    Cetak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Laporan Tagihan</h4>
                        <div class="pe-5 me-5">
                            <form action="{{ route('admin.laporan.pdf') }}" method="POST">
                                @csrf
                                @method('POST')
                                <label for="" class="mb-2">Pilih Tahun Laporan</label>
                                <div class="d-flex justify-content-around">
                                    <select name="id_angkatans" id="id_angkatans" class="form-select me-2">
                                        <option value="">--Pilih--</option>
                                        @foreach ($angkatan as $angkatans)
                                            <option value="{{ $angkatans->id }}">{{ $angkatans->tahun }}</option>
                                        @endforeach
                                    </select>
                                    <select name="id_jurusans" id="id_jurusans" class="form-select me-2">

                                    </select>
                                    <select name="id_kelas" id="id_kelas" class="form-select"></select>
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
                                <button type="submit"
                                    class="d-flex align-items-center justify-content-around px-5 btn btn-primary mt-3 col-md-2">
                                    <i class='bx bx-book-content'></i>
                                    Cetak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
