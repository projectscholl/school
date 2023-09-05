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
                    <h5 class="card-header">Edit Biaya</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.biaya.update', $biaya->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nama">Nama selectedBiaya</label>
                                <input type="text"
                                    class="form-control @error('nama_biaya')
                                is-invalid
                            @enderror"
                                    name="nama_biaya" id="nama_biaya" placeholder="Masukkan Nama Biaya"
                                    value="{{ old('nama_biaya', $biaya->nama_biaya) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jenis Biaya</label>
                                <input type="text" value="{{ $biaya->jenis_biaya }}"
                                    class="form-control @error('jenis_biaya')
                                is-invalid 
                            @enderror"
                                    id="status" name="jenis_biaya" readonly>
                                @error('jenis_biaya')
                                    <div>{{ $message }}</div>
                                @enderror
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

                                    @if ($biaya->jenis_biaya == 'routine')
                                        <tbody>
                                            @foreach ($biaya->tagihans as $index => $tagihans)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $tagihans->mounth }}
                                                        <input type="hidden" name="mounth[]" class="tess"
                                                            value="{{ $tagihans->mounth }}">
                                                    </td>
                                                    <td><input type="number"
                                                            class="form-control @error('amount[]')
                                                    is-invalid
                                                @enderror tess routine"
                                                            name="amount[]" value="{{ $tagihans->amount }}">
                                                    </td>
                                                    <td><input type="date" name="start_date[]"
                                                            class="form-control tess date1"
                                                            value="{{ $tagihans->start_date }}">
                                                    </td>
                                                    <td><input type="date" name="end_date[]"
                                                            class="form-control tess date2"
                                                            value="{{ $tagihans->end_date }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <!--Input date pembayaran tidak routine-->
                            @if ($biaya->jenis_biaya == 'tidakRoutine')
                                <div class="d-none" id="date">
                                    <div class="form-group mb-3">
                                        <label for="amount">Total biaya</label>
                                        @foreach ($biaya->tagihans as $tagihans)
                                            <input type="number"
                                                class="form-control @error('amount[]')
                                        is-invalid
                                    @enderror optional notroutine"
                                                name="amount[]" placeholder="Masukkan Nama Biaya"
                                                value="{{ $tagihans->amount }}">
                                            @foreach ($biaya->tagihans as $item)
                                                <input type="hidden" name="mounth[]" value="{{ $item->mounth }}"
                                                    class="optional">
                                            @endforeach
                                            @error('amount[]')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @endforeach

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="start_date">Tanggal mulai</label>
                                        @foreach ($biaya->tagihans as $tagihans)
                                            <input type="date" class="form-control optional time1" name="start_date[]"
                                                id="time" placeholder="Masukkan Nama Biaya"
                                                value="{{ $tagihans->start_date }}"re>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="end_date">Tanggal tenggat</label>
                                        @foreach ($biaya->tagihans as $tagihan)
                                            <input type="date" class="form-control optional time2" name="end_date[]"
                                                id="time" placeholder="" value="{{ $tagihan->end_date }}">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="form-group
                                        mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans"
                                    class="form-control @error('id_angkatans')
                                    is-invalid
                                @enderror"
                                    readonly="readonly" required>
                                    @foreach ($angkatan as $data)
                                        <option
                                            value="{{ $biaya->id_angkatans }}"{{ $data->id == $biaya->id_angkatans ? 'selected' : '' }}>
                                            {{ $data->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans"
                                    class="form-control @error('id_jurusans')
                                    is-invalid
                                @enderror"
                                    readonly="readonly" required>
                                    <option value="{{ $biaya->id_jurusans }}"{{ $biaya->id_jurusans ? 'selected' : '' }}
                                        readonly="readonly">
                                        {{ $biaya->jurusans->nama }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kelas">Masukkan kelas</label>
                                <select name="id_kelas" id="id_kelas"
                                    class="form-control @error('id_kelas')
                                    is-invalid
                                @enderror"
                                    readonly="readonly" required>
                                    <option value="{{ $biaya->id_kelas }}"{{ $biaya->id_jurusans ? 'selected' : '' }}
                                        readonly="readonly">
                                        {{ $biaya->kelas->kelas }}
                                    </option>
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
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        const status = document.getElementById('status');
        status.dispatchEvent(new Event('change'));
        if (status.value == 'routine') {
            document.getElementById('result').classList.remove('d-none');
            document.getElementById('date').classList.add('d-none');
            const routine = document.querySelectorAll('.routine');
            const date1 = document.querySelectorAll('.date1');
            const date2 = document.querySelectorAll('.date2');
            const optional = document.querySelectorAll('.optional');
            optional.forEach(function(optionals) {
                optionals.removeAttribute('name');
                optionals.removeAttribute('value');
                optionals.removeAttribute('required');
            });
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
            console.log(status.value);
            document.getElementById('result').classList.add('d-none');
            document.getElementById('date').classList.remove('d-none');
            const optionals = document.querySelector(".optional");
            const notRoutine = document.querySelectorAll(".notroutine");
            const time1 = document.querySelectorAll(".time1");
            const time2 = document.querySelectorAll(".time2");
            const collections = document.querySelectorAll(".tess");
            collections.forEach(function(collection) {
                collection.removeAttribute('name');
                collection.removeAttribute('value');
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
    </script>
@endpush
