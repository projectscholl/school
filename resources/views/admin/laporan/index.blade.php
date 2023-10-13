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
                            <form action="{{ route('admin.export.pembayaran') }}" method="POST">
                                @csrf
                                @method('POST')
                                <label for="" class="mb-2">Pilih Jenis Laporan</label>
                                <div class="d-flex justify-content-around">
                                    <select name="status" id="status"
                                        class="form-select me-2 @error('status')
                                        is-invalid
                                    @enderror">
                                        <option selected disabled>--Pilih--</option>
                                        <option value="all">SEMUA</option>
                                        <option value="pending">PENDING</option>
                                        <option value="expired">EXPIRED</option>
                                        <option value="berhasil">BERHASIL</option>
                                    </select>
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

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Laporan Tagihan</h4>
                        <div class="pe-5 me-5">
                            <form action="{{ route('admin.export.excel') }}" method="POST">
                                @csrf
                                @method('POST')
                                <label for="" class="mb-2">Pilih Tahun Laporan</label>
                                <div class="d-flex justify-content-around">
                                    <select name="id_angkatans" id="id_angkatans"
                                        class="form-select me-2 @error('id_angkatans')
                                        is-invalid
                                    @enderror">
                                        <option value="">--Pilih--</option>
                                        @foreach ($angkatan as $angkatans)
                                            <option value="{{ $angkatans->id }}">{{ $angkatans->tahun }}</option>
                                        @endforeach
                                    </select>
                                    <select name="id_jurusans" id="id_jurusans"
                                        class="form-select me-2 @error('id_jurusans')
                                        is-invalid
                                    @enderror">

                                    </select>
                                    <select name="id_kelas" id="id_kelas"
                                        class="form-select @error('id_kelas')
                                        is-invalid
                                    @enderror"></select>
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
@endpush
