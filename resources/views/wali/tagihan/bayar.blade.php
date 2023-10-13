</html>@extends('layouts.master')

@section('title, detail')
@section('content')

    <!-- Layout container -->
    <div class="layout-page overflow-auto">
        <!-- Navbar -->
        <x-navbar>

        </x-navbar>

        <!-- / Navbar -->

        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">Pembayaran Bank</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <form action="{{ route('wali.tagihan.bayar.create') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_pengirim" class="mb-2">Nama Pengirim</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Pengirim" name="nama_pengirim" required>
                                </div>
                            
                                @foreach ($tagihanDetails as $tagihanDetail)
                                    <input type="hidden" name="id_tagihan_details[]" value="{{ $tagihanDetail->id }}">
                                @endforeach
                                <input type="hidden" name="total_bayar" value="{{ $totalTagihan }}">
                                <p></p>
                            
                                <div class="form-group mb-3">
                                    <label for="rek_pengirim" class="mb-2">Rekening Pengirim</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Nomor Rekening Pengirim" name="rek_pengirim" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="identitas_penerima" class="mb-2">Rekening Sekolah</label>
                                    <select name="identitas_penerima" id="identitas_penerima" class="form-control">
                                        <option disabled>------</option>
                                        @foreach ($bank as $banks)
                                            <option value="{{ $banks->id }}">{{ $banks->nama }} ({{ $banks->no_rekening }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="bukti_transaksi" class="mb-2">Bukti Transfer</label>
                                    <input type="file" class="form-control" name="bukti_transaksi" placeholder="Masukkan Nama Pengirim"  accept=".jpg, .jpeg, .png" required>
                                </div>
                                <div class="container mx-auto d-flex justify-content-center align-items-center gap-2">
                                    <button type="submit" class="btn btn-primary my-4 w-50 text-light">Konfirmasi</button>
                                </div>
                            </form>
                            
                            <script>
                                function validateForm() {
                                    var rekPengirim = document.getElementsByName("rek_pengirim")[0].value;
                                    if (rekPengirim.length !== 16) {
                                        alert("Nomor rekening harus terdiri dari 16 digit.");
                                        return false;
                                    }
                            
                                    var buktiTransaksi = document.getElementsByName("bukti_transaksi")[0].value;
                                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                                    if (!allowedExtensions.exec(buktiTransaksi)) {
                                        alert("Tipe file yang diizinkan hanya .jpg, .jpeg, atau .png.");
                                        return false;
                                    }
                            
                                    return true;
                                }
                            </script>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
