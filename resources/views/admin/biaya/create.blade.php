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
                        <div class="form-group mb-3 d-none" id="all">
                            <label for="">Masukkan Seluruh Total Biaya</label>
                            <form onsubmit="return false">
                                <div class="d-flex">
                                    <input type="text" class="form-control rupiah" id="input_form"
                                        placeholder="Optional : 200.000">
                                    <button class="btn btn-success ms-2" id="tombol_form">Click</button>
                                </div>
                            </form>
                        </div>
                        <form action="{{ route('admin.biaya.store') }}" method="POST" id="form">
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
                                    <option value="routine" {{ old('jenis_biaya') == 'routine' ? 'selected' : '' }}>
                                        Routine
                                    </option>
                                    <option value="tidakRoutine"
                                        {{ old('jenis_biaya') == 'tidakRoutine' ? 'selected' : '' }}>
                                        Tidak routine</option>
                                </select>
                                <span class="fs">--Harus memilih jenis biaya--</span>
                            </div>
                            <!--table pembayaran perbulan-->
                            <div class="form-group mb-3">
                                @php
                                    $tanggal2 = ['28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '09', '08', '07', '06', '05', '04', '03', '02', '01'];
                                    $tanggal = ['30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '09', '08', '07', '06', '05', '04', '03', '02', '01'];
                                    $tanggal3 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                                    $tanggal4 = ['31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31'];
                                    $tanggal5 = ['01', '01', '01', '01', '01', '01', '01', '01', '01', '01', '01', '01'];
                                    $tahun = date('Y');
                                @endphp
                                <table class="table table-bordered d-none" id="result">
                                    <tr>
                                        <td colspan="4">

                                        </td>
                                    </tr>
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>Total biaya</th>
                                            <th>Tanggal tenggat</th>
                                        </tr>
                                    </thead>

                                    {{-- this input yang routine --}}
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <p></p>
                                            <td>July<input type="hidden" value="{{ $tahun }}-07-01" name="mounth[]"
                                                    class="mounth tess">
                                            </td>
                                            <td>
                                                <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.0')
                                                    is-invalid
                                                @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.0') }}">
                                                @error('amount.0')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}</option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-07">

                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan July
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-07">{{ $tanggals }} July
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.0')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Agustus <input type="hidden" value="{{ $tahun }}-08-01"
                                                    name="mounth[]" class="mounth tess">
                                            </td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.1')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.1') }}">
                                                @error('amount.1')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-08">

                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan Agustus
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-08">{{ $tanggals }} Agustus
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.1')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>September<input type="hidden" value="{{ $tahun }}-09-01"
                                                    name="mounth[]" class="mounth tess"></td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.2')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.2') }}">
                                                @error('amount.2')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-09">
                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan September
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-09">{{ $tanggals }}
                                                            September
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.2')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Oktober<input type="hidden" value="{{ $tahun }}-10-01"
                                                    name="mounth[]" class="mounth tess">
                                            </td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.3')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.3') }}">
                                                @error('amount.3')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-10">
                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan Oktober
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-10">{{ $tanggals }}
                                                            Oktober
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.3')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>November<input type="hidden" value="{{ $tahun }}-11-01"
                                                    name="mounth[]" class="mounth tess">
                                            </td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.4')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.4') }}">
                                                @error('amount.4')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-11">
                                            <td>
                                                <select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan November
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-11">{{ $tanggals }}
                                                            November
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.4')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Desember<input type="hidden" value="{{ $tahun }}-12-01"
                                                    name="mounth[]" class="mounth tess"></td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.5')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.5') }}">
                                                @error('amount.5')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-12">

                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan Desember
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-12">{{ $tanggals }} Maret
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.5')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>January<input type="hidden" value="{{ $tahun }}-01-01"
                                                    name="mounth[]" class="mounth tess"></td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.6')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.6') }}">
                                                @error('amount.6')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-01">

                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan January
                                                    </option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-01">{{ $tanggals }}
                                                            January
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.6')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Febuary<input type="hidden" value="{{ $tahun }}-02-01"
                                                    name="mounth[]" class="mounth tess"></td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.7')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.7') }}">
                                                @error('amount.7')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-02">
                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan February
                                                    </option>
                                                    @foreach ($tanggal2 as $tanggals2)
                                                        <option value="{{ $tanggals2 }}-02">{{ $tanggals2 }}
                                                            February
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.7')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Maret<input type="hidden" value="{{ $tahun }}-03-01"
                                                    name="mounth[]" class="mounth tess"></td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.8')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.8') }}">
                                                @error('amount.8')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-03">
                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan Maret</option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-03">{{ $tanggals }} Maret
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.8')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>April<input type="hidden" value="{{ $tahun }}-04-01"
                                                    name="mounth[]" class="mounth tess"></td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.9')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.9') }}">
                                                @error('amount.9')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-04">
                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan April</option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-04">{{ $tanggals }} April
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.9')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>11</td>
                                            <td>Mey <input type="hidden" value="{{ $tahun }}-05-01"
                                                    name="mounth[]" class="mounth tess">
                                            </td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.10')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.10') }}">
                                                @error('amount.10')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-05">
                                            <td><select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan Mei</option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-05">{{ $tanggals }} Mey
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.10')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12 <input type="hidden" value="{{ $tahun }}-06-01"
                                                    name="mounth[]" class="mounth tess">
                                            </td>
                                            <td>Juny</td>
                                            <td> <input list="harga" name="amount[]"
                                                    class="form-control @error('amount.11')
                                                is-invalid
                                            @enderror tess routine rupiah hasil"
                                                    value="{{ old('amount.11') }}">
                                                @error('amount.11')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <datalist id="harga">
                                                    @foreach ($master as $masters)
                                                        <option value="{{ $masters->harga }}">{{ $masters->name }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <input type="hidden" name="start_date[]" class="tess date1" value="01-06">
                                            <td>
                                                <select name="end_date[]" id="" class="form-select tess date2">
                                                    <option value="" disabled>Pilih Tanggal Pada Bulan Juny</option>
                                                    @foreach ($tanggal as $tanggals)
                                                        <option value="{{ $tanggals }}-06">{{ $tanggals }} Juny
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('end_date.11')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--Input date pembayaran tidak routine-->

                            <div class="d-none" id="date">
                                <div class="form-group mb-3">
                                    <label for="mount">Total biaya</label>
                                    <input type="hidden" value="" name="mounth[]" class="optional bulan">
                                    <input list="harga" type="text" name="amount[]" value="{{ old('amount.0') }}"
                                        class="form-control @error('amount.*')
                                    is-invalid
                                @enderror optional notroutine rupiah">
                                    <datalist id="harga">
                                        @foreach ($master as $masters)
                                            <option value="{{ $masters->harga }}">{{ $masters->name }}</option>
                                        @endforeach
                                    </datalist>
                                    @error('amount.*')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_date">Tanggal mulai</label>
                                    <select name="start_date[]" id="" class="form-select optional time1"
                                        placeholder="Masukkan Nama Biaya">
                                        <option value="" disabled>Pilih Tanggal dan Bulan di Awal</option>
                                        @foreach ($tanggal3 as $index => $tree)
                                            <option value="{{ $tanggal5[$index] }}-{{ $tree }}">
                                                {{ $tanggal5[$index] }}
                                                {{ Carbon\Carbon::parse('1990-' . $tree)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('start_date.0')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_date">Tanggal tenggat</label>
                                    <select name="end_date[]" id="" class="form-select optional time2">
                                        <option value="" disabled>Pilih Tanggal dan Bulan di Akhir</option>
                                        @foreach ($tanggal3 as $index => $tree)
                                            <option value="{{ $tanggal4[$index] }}-{{ $tree }}">
                                                {{ $tanggal4[$index] }}
                                                {{ Carbon\Carbon::parse('1990-' . $tree)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('end_date.0')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control" required>
                                    @if ($angkatans)
                                        <option value="">--Pilih--</option>
                                    @else
                                        <option value="">--Silahkan buat data angkatan terlebih dahulu !--
                                        </option>
                                    @endif
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                    @endforeach
                                </select>
                                @error('id_angkatans')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans" class="form-control" required>

                                </select>
                                @error('id_jurusans')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kelas">Masukkan kelas</label>
                                <select name="id_kelas" id="id_kelas" class="form-control" required>

                                </select>
                                @error('id_kelas')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <script>
                                    const angkatanSelect = document.getElementById('id_angkatans');
                                    const jurusanSelect = document.getElementById('id_jurusans');
                                    const kelasSelect = document.getElementById('id_kelas');

                                    const jurusanGrouped = @json($jurusanGrouped);
                                    const kelasGrouped = @json($kelasGrouped);
                                    const jurusans = @json($jurusans);
                                    const kelas = @json($kelas);

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

        function enableBrand(status) {
            event.preventDefault();
            if (status.value == "routine") {
                document.getElementById('result').classList.remove('d-none');
                document.getElementById('date').classList.add('d-none');
                document.getElementById('all').classList.remove('d-none');
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
                    mounth[i].setAttribute('name', 'mounth[]');
                }
                for (i = 0; i < routine.length; i++) {
                    routine[i].setAttribute('name', 'amount[]');
                    routine[i].setAttribute('required', true);

                }
                for (i = 0; i < date1.length; i++) {
                    date1[i].setAttribute('name', 'start_date[]');
                }
                for (i = 0; i < date2.length; i++) {
                    date2[i].setAttribute('name', 'end_date[]');
                    date2[i].setAttribute('required', true);
                }

            } else if (status.value == "tidakRoutine") {
                document.getElementById('all').classList.add('d-none');
                document.getElementById('result').classList.add('d-none');
                document.getElementById('date').classList.remove('d-none');
                const bulan = document.querySelectorAll('.bulan');
                const optionals = document.querySelector(".optional");
                const notRoutine = document.querySelectorAll(".notroutine");
                const time1 = document.querySelectorAll(".time1");
                const time2 = document.querySelectorAll(".time2");
                const collections = document.querySelectorAll(".tess");
                collections.forEach(function(collection) {
                    collection.removeAttribute('name');
                    collection.removeAttribute('required');
                });
                for (i = 0; i < bulan.length; i++) {
                    bulan[i].setAttribute('name', 'mounth[]');
                }
                for (i = 0; i < notRoutine.length; i++) {
                    notRoutine[i].setAttribute('name', 'amount[]');
                    notRoutine[i].setAttribute('required', true);
                }
                for (i = 0; i < time1.length; i++) {
                    time1[i].setAttribute('name', 'start_date[]');
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
