@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5>Ubah Data Kelas</h5>
                        <p>*Harus Mempunyai Data angkatan dan Jurusan terlebih dahulu!*</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control">
                                    <option value="">---------</option>
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}" {{ old('id_angkatans', $kelas->id_angkatans) == $data->id ? 'selected' : '' }}>{{ $data->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" id="id_jurusans" class="form-control">
                                    
                                </select>
                                <script>
                                    const angkatanSelect = document.getElementById('id_angkatans');
                                    const jurusanSelect = document.getElementById('id_jurusans');
                                
                                    const jurusanGrouped = @json($jurusanGrouped);
                                
                                    angkatanSelect.addEventListener('change', () => {
                                        const angkatanId = angkatanSelect.value;
                                        const jurusanOptions = jurusanGrouped[angkatanId] || [];
                                
                                    
                                        jurusanSelect.innerHTML = '';
                                
                                        jurusanOptions.forEach(jurusan => {
                                            const option = document.createElement('option');
                                            option.value = jurusan.id;
                                            option.textContent = jurusan.nama;
                                            jurusanSelect.appendChild(option);
                                        });
                                    });
                                </script>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kelas">Masukkan kelas</label>
                                <input type="text" placeholder="10" class="form-control" name="kelas"
                                    value="{{ $kelas->kelas }}">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
