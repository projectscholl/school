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
                        <form action="{{ route('admin.biaya.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Biaya</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukkan Nama Biaya">
                                </div>
                                <label for="id_angkatans">Angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control mb-3" required>
                                    <option disabled selected>-------</option>
                                    @foreach ($angkatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                                    @endforeach
                                </select>

                                <label for="id_jurusans">Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans" class="form-control mb-3" required>
                                    <option disabled selected>-------</option>
                                    @foreach ($jurusans as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>

                                <label for="id_kelas">Kelas</label>
                                <select name="id_kelas" id="kelas" class="form-control mb-3" required>
                                    <option disabled selected>-------</option>
                                </select>
                                {{-- <script>
                                    const angkatanSelect = document.getElementById('id_angkatans');
                                    const jurusanSelect = document.getElementById('id_jurusans');
        
                                    // Data jurusan (ambil dari variabel PHP yang dikirim ke tampilan)
                                    const jurusanData = @json($jurusans);
        
                                    angkatanSelect.addEventListener('change', () => {
                                        const angkatanId = angkatanSelect.value;
                                        const jurusanOptions = jurusanData[angkatanId] || [];
        
                                        jurusanSelect.innerHTML = '<option disabled selected>-------</option>';
        
                                        jurusanOptions.forEach(jurusan => {
                                            const option = document.createElement('option');
                                            option.value = jurusan.id;
                                            option.textContent = jurusan.nama;
                                            jurusanSelect.appendChild(option);
                                        });
                                    });
                                </script> --}}
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Total Biaya</label>
                                <input type="number" class="form-control" name="total_biaya" id="total_biaya"
                                    placeholder="Masukkan Total Biaya">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
