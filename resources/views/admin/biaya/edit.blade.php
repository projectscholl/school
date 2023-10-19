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
                        @if ($biaya->jenis_biaya == 'routine')
                            <div class="form-group mb-3" id="all">
                                <label for="">Masukkan Seluruh Total Biaya</label>
                                <form onsubmit="return false">
                                    <div class="d-flex">
                                        <input type="text" class="form-control rupiah" id="input_form"
                                            placeholder="Optional : 200.000">
                                        <button class="btn btn-success ms-2" id="tombol_form">Click</button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <form action="{{ route('admin.biaya.update', $biaya->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="nama">Nama Biaya</label>
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
                                            <th>Tanggal tenggat</th>
                                        </tr>
                                    </thead>

                                    {{-- this input yang routine --}}
                                    @php
                                        $tanggal2 = ['28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '09', '08', '07', '06', '05', '04', '03', '02', '01'];
                                        $tanggal = ['30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '09', '08', '07', '06', '05', '04', '03', '02', '01'];
                                        $tanggal3 = ['07', '08', '09', '10', '11', '12', '01', '02', '03', '04', '05', '06'];
                                        $tahun = date('Y');
                                        $tanggal4 = ['31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31'];

                                        $tanggal5 = ['01', '01', '01', '01', '01', '01', '01', '01', '01', '01', '01', '01'];
                                        $tanggal6 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                                        $date1 = date('Y');
                                        $date2 = date('Y') + 1;
                                    @endphp

                                    @if ($biaya->jenis_biaya == 'routine')
                                        <tbody>
                                            @foreach ($biaya->tagihans as $index => $tagihans)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($tagihans->mounth)->format('F') }}
                                                        <input type="hidden" name="mounth[]" class="tess"
                                                            value="{{ $tagihans->mounth }}">
                                                    </td>
                                                    <td><input type="number"
                                                            class="form-control @error('amount[]')
                                                    is-invalid
                                                @enderror tess routine rupiah hasil"
                                                            name="amount[]" value="{{ $tagihans->amount }}">
                                                    </td>
                                                    <input type="hidden" name="start_date[]"
                                                        class="form-control tess date1" value="{{ $tagihans->start_date }}">

                                                    {{-- @for ($date = $startDate; $date->lte($endDate); $date->addDay())
                                                        {{ $date->format('m-d') }} <br>
                                                    @endfor --}}
                                                    {{ Carbon\Carbon::parse($tagihans->end_date)->format('m') }}
                                                    <td><select name="end_date[]" id="" class="form-select">
                                                            <option value="" disabled>Pilih Tanggal Pada Bulan
                                                            </option>
                                                            @if (Carbon\Carbon::parse($tagihans->end_date)->format('m') === '02')
                                                                @foreach ($tanggal2 as $tanggals)
                                                                    <option
                                                                        value="{{ $tanggals . '-' . $tanggal3[$index] . '-' }}{{ Carbon\Carbon::parse($tagihans->end_date)->format('m') === '07' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '08' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '09' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '10' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '11' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '12' ? $date1 : $date2 }}"
                                                                        {{ Carbon\Carbon::parse($tagihans->end_date)->format('d-m') == $tanggals . '-' . $tanggal3[$index] ? 'selected' : '' }}>
                                                                        {{ \Carbon\Carbon::parse($tanggals . '-' . $tanggal3[$index] . '-' . date('Y'))->format('d F') }}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                @foreach ($tanggal as $tanggals)
                                                                    <option
                                                                        value="{{ $tanggals . '-' . $tanggal3[$index] . '-' }}{{ Carbon\Carbon::parse($tagihans->end_date)->format('m') === '07' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '08' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '09' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '10' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '11' || Carbon\Carbon::parse($tagihans->end_date)->format('m') === '12' ? $date1 : $date2 }}"
                                                                        {{ Carbon\Carbon::parse($tagihans->end_date)->format('d-m') == $tanggals . '-' . $tanggal3[$index] ? 'selected' : '' }}>
                                                                        {{ \Carbon\Carbon::parse($tanggals . '-' . $tanggal3[$index] . '-' . date('Y'))->format('d F') }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <input type="hidden" name="id[]" value="{{ $tagihans->id }}">
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                                <script>
                                    const angkatanSelect = document.getElementById('id_angkatans');
                                    const jurusanSelect = document.getElementById('id_jurusans');
                                    const kelasSelect = document.getElementById('id_kelas');

                                    const jurusanGrouped = @json($jurusanGrouped);
                                    const kelasGrouped = @json($kelasGrouped);

                                    angkatanSelect.dispatchEvent(new Event('change'));
                                    const angkatanId = angkatanSelect.value;
                                    const jurusanOptions = jurusanGrouped[angkatanId] || [];

                                    jurusanSelect.innerHTML = '<option value="">Pilih Kelas</option>';
                                    jurusanOptions.forEach(jurusan => {
                                        const option = document.createElement('option');
                                        option.value = jurusan.id;
                                        option.textContent = jurusan.nama;
                                        jurusanSelect.appendChild(option);
                                    });


                                    const jurusanId = jurusanSelect.value;
                                    const kelasOptions = kelasGrouped[jurusanId] || [];

                                    kelasSelect.innerHTML = '';

                                    kelasOptions.forEach(kelas => {
                                        const option = document.createElement('option');
                                        option.value = kelas.id;
                                        option.textContent = kelas.kelas;
                                        kelasSelect.appendChild(option);
                                    });
                                </script>
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
                                    @enderror optional notroutine rupiah"
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
                                    {{-- <div class="form-group mb-3">
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
                                            <input type="hidden" name="id[]" value="{{ $tagihan->id }}">
                                        @endforeach
                                    </div>
                                    --}}
                                    <div class="form-group mb-3">
                                        <label for="start_date">Tanggal mulai</label>
                                        <select name="start_date[]" id="time" class="form-select optional time1"
                                            placeholder="Masukkan Nama Biaya">
                                            <option value="" disabled>Pilih Tanggal dan Bulan di Awal</option>
                                            @foreach ($tanggal6 as $index => $tree)
                                                <option value="{{ $tanggal5[$index] }}-{{ $tree }}"
                                                    {{ $tanggal5[$index] . '-' . $tree == $tagihans->start_date ? 'selected' : '' }}>
                                                    {{ $tanggal5[$index] }}
                                                    {{ Carbon\Carbon::parse('1990-' . $tree)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="end_date">Tanggal tenggat</label>
                                        <select name="end_date[]" id="time" class="form-select optional time2">
                                            <option value="" disabled>Pilih Tanggal dan Bulan di Akhir</option>
                                            @foreach ($tanggal6 as $index => $tree)
                                                <option value="{{ $tanggal4[$index] }}-{{ $tree }}"
                                                    {{ $tanggal4[$index] . '-' . $tree == $tagihans->end_date ? 'selected' : '' }}>
                                                    {{ $tanggal4[$index] }}

                                                    <!--Ini format untuk menjadikan tanggal ke bulan-->
                                                    {{ Carbon\Carbon::parse('1990-' . $tree)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="id[]" value="{{ $tagihans->id }}">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group
                                        mb-3">
                                <label for="id_angkatans">Angkatan</label>
                                <input type="text" class="form-control" value="{{ $biaya->angkatans->tahun }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Jurusan</label>
                                <input type="text" class="form-control" readonly value=" {{ $biaya->jurusans->nama }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kelas">Masukkan kelas</label>
                                <input type="text" class="form-control" readonly value="{{ $biaya->kelas->kelas }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah</button>
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
    <script src="{{ asset('sneat/js/jquery.mask.min.js') }}"></script>
    <script>
        $('.rupiah').mask("#.##0", {
            reverse: true
        });
    </script>
    <script type="text/javascript">
        document.getElementById("tombol_form").addEventListener("click", tampilkan_nilai_form);

        function tampilkan_nilai_form() {
            event.preventDefault();
            var nilai_form = document.getElementById("input_form").value;
            const hasil = document.querySelectorAll('.hasil');
            for (var i = 0; i < hasil.length; i++) {
                hasil[i].setAttribute('value', nilai_form);
                hasil[i].value = nilai_form;
            }
        }
    </script>
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
