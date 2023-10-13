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
                    <h5 class="card-header">Detail Murid</h5>
                    <div class="card-body">
                        <div>NAMA : {{ $murids->name }} </div>
                        <hr>
                        <div>ANGKATAN : {{ $murids->angkatans->tahun ?? 'Tidak ada Angkatan' }} </div>
                        <hr>
                        <div>JURUSAN : {{ $murids->jurusans->nama }} </div>
                        <hr>
                        <div>KELAS : {{ $murids->kelas->kelas ?? 'Tidak ada Kelas' }} </div>
                        <hr>
                        <div>NAMA WALI : {{ $murids->User->name ?? 'Tidak Ada Wali' }}</div>
                        <hr>
                        <div>NAMA AYAH : {{ $murids->ayahs->name }}</div>
                        <hr>
                        <div>NAMA IBU : {{ $murids->ibus->name }}</div>
                    </div>
                </div>
                <!-- Transactions -->
                <div class="card mt-3">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me<td>-2">Total Tagihan</h5>
                        </td>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="">
                            <form action="{{ route('admin.murid.bayar', $murids->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered mb-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tagihan</th>
                                            <th>Tanggal Penagihan</th>
                                            <th>Status</th>
                                            <th>Total Tagihan</th>
                                            <th class="d-flex align-items-center"><input type="checkbox" id="select_all_ids"
                                                    class="me-2"> Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($tagihanDetail != null)
                                            @foreach ($tagihanDetail as $key => $tagihan)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $tagihan->nama_biaya }}</td>
                                                    <td>{{ Carbon\Carbon::parse($tagihan->end_date . '-' . date('Y'))->format('d F') }}
                                                    </td>
                                                    </td>
                                                    <td>{{ $tagihan->status }}</td>
                                                    <td>Rp {{ number_format($tagihan->jumlah_biaya, 2, ',', '.') }}</td>
                                                    <td><input type="checkbox" name="id[]" value="{{ $tagihan->id }}"
                                                            {{ $tagihan->status == 'SUDAH' ? 'disabled' : '' }}
                                                            class="checksAll">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-100">null</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <button type="submit" href="" class="btn btn-primary">Bayar</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
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
            toastr.success('{{ Session::get('pesan') }}')
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"
        integrity="sha512-mJQ9oQHzLM2zXe1cwiHmnMddNrmjv1YlaKZe1rM4J7q8JTnNn9UgeJVBV9jyV/lVGdXymVx6odhgwNZjQD8AqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js"
        integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#select_all_ids').on('click', function() {
                if (this.checked) {
                    $('.checksAll').each(function() {
                        this.checked = true
                    })
                } else {
                    $('.checksAll').each(function() {
                        this.checked = false
                    })
                }
            });

            $('.checksAll').on('click', function() {
                if ($('.checksAll:checked').length == $('checksAll').length) {
                    $('#select_all_ids').prop('checked', true)
                } else {
                    $('#select_all_ids').prop('checked', false)
                }
            });
        });

        function destroy(event) {
            event.preventDefault()

            if ($('.checksAll').is(':checked')) {
                Swal.fire({
                    title: 'Yakin?',
                    text: "Kamu Akan Menghapus Biaya!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya,  Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.form1.action = "{{ route('admin.biaya.delete') }}"
                        document.form1.submit()

                        Swal.fire(
                            'Terhapus!',
                            'Kamu telah menghapus Biaya!!.',
                            'success'
                        )
                    }
                });
            }
            if (!$('.checksAll').is(':checked')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href="">Why do I have this issue?</a>'
                })
            }
        }
    </script>
@endpush
