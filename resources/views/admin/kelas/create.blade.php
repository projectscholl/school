@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data kelas</h5>
                        <p>*Harus Mempunyai Data angkatan dan Jurusan terlebih dahulu!*</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kelas.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="id_angkatans">Masukkan angkatan</label>
                                <select name="id_angkatans" id="id_angkatans" class="form-control input">
                                    <option value="">--Pilih--</option>
                                    @foreach ($angkatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->tahun }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Masukkan Jurusan</label>
                                <select name="id_jurusans" class="form-control" id="id_jurusans">

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kelas">Masukkan kelas</label>
                                <input type="number" placeholder="10" class="form-control" name="kelas">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#id_angkatans').on('change', function() {
                var kode_angkatan = $(this).val();
                // console.log(kode_angkatan);
                if (kode_angkatan) {
                    $.ajax({
                        url: 'getJurusan/' + kode_angkatan,
                        type: 'GET',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                $('#id_jurusans').empty();
                                $('#id_jurusans').append('<option value="">--pilih--</option>');
                                $.each(data, function(key, id_jurusans) {
                                    $('select[name="id_jurusans"]').append(
                                        '<option value="' + id_jurusans.id + '">' +
                                        id_jurusans.nama + '</option>'
                                    );
                                });
                            } else {
                                $('#id_jurusans').empty();
                            }
                        }
                    });
                } else {
                    $('#id_jurusans').empty();
                }
            });
        });
    </script>
@endpush
