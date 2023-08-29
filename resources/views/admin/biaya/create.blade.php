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
                    <h5 class="card-header">Tambah Biaya</h5>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.biaya.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama">Nama Biaya</label>
                                <input type="text" class="form-control" name="nama_biaya" id="nama_biaya"
                                    placeholder="Masukkan Nama Biaya">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jenis Biaya</label>
                                <select name="jenis_biaya" id="status" class="form-control mb-3"
                                    onchange="enableBrand(this)">
                                    <option disabled selected>-------</option>
                                    <option value="routine">Routine</option>
                                    <option value="tidakRoutine">Tidak routine</option>
                                </select>
                            </div>
                            <!--table pembayaran perbulan-->
                            <div class="form-group mb-3">
                                <table class="table table-bordered d-none" id="result">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>Total biaya</th>
                                            <th>tanggal mulai</th>
                                            <th>Tanggal tenggat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>July</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Agustus</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>September</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Oktober</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>November</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Desember</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>January</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id=""
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Febuary</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id=""
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Maret</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id=""
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>April</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id=""
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Mey</td>
                                            <td><input type="number" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id=""
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>Juny</td>
                                            <td><input type="amount" class="form-control" name="amount[]"></td>
                                            <td><input type="date" name="start_date[]" id=""
                                                    class="form-control">
                                            </td>
                                            <td><input type="date" name="end_date[]" id=""
                                                    class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--Input date pembayaran tidak routine-->
                            <div class="d-none" id="date">
                                <div class="form-group mb-3">
                                    <label for="start_date">Tanggal mulai</label>
                                    <input type="date" class="form-control" name="start_date[]" id="start_date"
                                        placeholder="Masukkan Nama Biaya">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_date">Tanggal mulai</label>
                                    <input type="date" class="form-control" name="end_date[]" id="end_date"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_date">Total biaya</label>
                                    <input type="number" class="form-control" name="mount[]" id="mount"
                                        placeholder="Masukkan Nama Biaya">
                                </div>
                            </div>
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
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function enableBrand(status) {
            console.log(status.value);
            if (status.value == "routine") {
                document.getElementById('result').classList.remove('d-none');
                document.getElementById('date').classList.add('d-none');

            } else if (status.value == "tidakRoutine") {
                document.getElementById('result').classList.add('d-none');
                document.getElementById('date').classList.remove('d-none');

            } else {
                document.getElementById('result').classList.add('d-none');
                document.getElementById('date').classList.add('d-none');

            }
        }
    </script>
@endpush
