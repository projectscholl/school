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
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>       
                            </div>
                        @endif --}}
                        <form action="{{ route('admin.biaya.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama">Nama Biaya</label>
                                <input type="text"
                                    class="form-control @error('nama_biaya')
                                is-invalid
                            @enderror"
                                    name="nama_biaya" id="nama_biaya" placeholder="Masukkan Nama Biaya"
                                    value="{{ old('nama_biaya') }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jenis Biaya</label>
                                <select name="jenis_biaya" id="status"
                                    class="form-control @error('jenis_biaya')
                                    is-invalid 
                                @enderror"
                                    onchange="enableBrand(this)" required>
                                    <option selected>--Pilih---</option>
                                    <option value="routine">Routine
                                    </option>
                                    <option value="tidakRoutine">Tidak routine</option>
                                </select>
                                <span class="fs">--Harus memilih jenis biaya--</span>
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

                                    {{-- this input yang routine --}}
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>July<input type="hidden" value="July" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                    is-invalid
                                                @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}" id="harga"></td>
                                            <td><input type="date" name="start_date[]" class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Agustus <input type="hidden" value="Agustus" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]" class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>September<input type="hidden" value="September" name="mounth[]"
                                                    class="mounth tess"></td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]" class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Oktober<input type="hidden" value="Oktober" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]" class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>November<input type="hidden" value="November" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]" class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Desember<input type="hidden" value="Desember" name="mounth[]"
                                                    class="mounth tess"></td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>January<input type="hidden" value="January" name="mounth[]"
                                                    class="mounth tess"></td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Febuary<input type="hidden" value="February" name="mounth[]"
                                                    class="mounth tess"></td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Maret<input type="hidden" value="Maret" name="mounth[]"
                                                    class="mounth tess"></td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>April<input type="hidden" value="April" name="mounth[]"
                                                    class="mounth tess"></td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Mey <input type="hidden" value="Mei" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12 <input type="hidden" value="Juny" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td>Juny</td>
                                            <td><input type="text"
                                                    class="form-control @error('amount[]')
                                                is-invalid
                                            @enderror tess routine rupiah"
                                                    name="amount[]" value="{{ old('amount[]') }}"></td>
                                            <td><input type="date" name="start_date[]"
                                                    class="form-control tess date1">
                                            </td>
                                            <td><input type="date" name="end_date[]" class="form-control tess date2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--Input date pembayaran tidak routine-->

                            <div class="d-none" id="date">
                                <div class="form-group mb-3">
                                    <label for="mount">Total biaya</label>
                                    <input type="hidden" value="" name="mounth[]" class="optional">
                                    <input type="text"
                                        class="form-control @error('amount[]')
                                        is-invalid
                                    @enderror optional notroutine rupiah"
                                        name="amount[]" placeholder="Masukkan Nama Biaya" value="{{ old('amount[]') }}">
                                    @error('amount[]')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_date">Tanggal mulai</label>
                                    <input type="date" class="form-control optional time1" name="start_date[]"
                                        id="time" placeholder="Masukkan Nama Biaya">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_date">Tanggal tenggat</label>
                                    <input type="date" class="form-control optional time2" name="end_date[]"
                                        id="time" placeholder="">
                                </div>

                            </div>
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control" required>
                                    <option value="">---------</option>
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans" class="form-control" required>

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kelas">Masukkan kelas</label>
                                <select name="id_kelas" id="id_kelas" class="form-control" required>

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
                            <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
    </div>
@endsection
@push('scripts')

    <script src="{{ asset('sneat/js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
        })
    </script>
    <script type="text/javascript">
        function enableBrand(status) {
            if (status.value == "routine") {
                document.getElementById('result').classList.remove('d-none');
                document.getElementById('date').classList.add('d-none');
                const mounth = document.querySelectorAll('.mounth');
                const routine = document.querySelectorAll('.routine');
                const date1 = document.querySelectorAll('.date1');
                const date2 = document.querySelectorAll('.date2');
                const optional = document.querySelectorAll('.optional');

                optional.forEach(function(optionals) {
                    optionals.removeAttribute('name');
                    optionals.removeAttribute('value');
                    optionals.removeAttribute('required');
                });
                for (i = 0; i < mounth.length; i++) {
                    routine[i].setAttribute('name', 'mounth[]');
                }
                for (i = 0; i < routine.length; i++) {
                    routine[i].setAttribute('name', 'amount[]');
                    routine[i].setAttribute('required', true);
                }
                for (i = 0; i < date1.length; i++) {
                    date1[i].setAttribute('name', 'start_date[]');
                    date1[i].setAttribute('required', true);
                }
                for (i = 0; i < date2.length; i++) {
                    date2[i].setAttribute('name', 'end_date[]');
                    date2[i].setAttribute('required', true);
                }
            } else if (status.value == "tidakRoutine") {
                document.getElementById('result').classList.add('d-none');
                document.getElementById('date').classList.remove('d-none');
                const optionals = document.querySelector(".optional");
                const notRoutine = document.querySelectorAll(".notroutine");
                const time1 = document.querySelectorAll(".time1");
                const time2 = document.querySelectorAll(".time2");
                const collections = document.querySelectorAll(".tess");
                collections.forEach(function(collection) {
                    collection.removeAttribute('name');
                    collection.removeAttribute('required');
                });
                for (i = 0; i < notRoutine.length; i++) {
                    notRoutine[i].setAttribute('name', 'amount[]');
                    notRoutine[i].setAttribute('required', true);
                }
                for (i = 0; i < time1.length; i++) {
                    time1[i].setAttribute('name', 'start_date[]');
                    time1[i].setAttribute('required', true);
                }
                for (i = 0; i < time2.length; i++) {
                    time2[i].setAttribute('name', 'end_date[]');
                    time2[i].setAttribute('required', true);
                }

            } else {
                const collections = document.querySelectorAll(".tess");
                const optional = document.querySelectorAll('.optional');
                collections.forEach(function(collection) {
                    collection.removeAttribute('required');
                });
                optional.forEach(function(optionals) {
                    optionals.removeAttribute('required');
                });

                document.getElementById('result').classList.add('d-none');
                document.getElementById('date').classList.add('d-none');

            }
        }
    </script>
@endpush
