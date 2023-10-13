@extends('layouts.master')

@section('title', 'Pembayaran')
@section('content')

    <!-- Layout container -->
    <div class="layout-page">

        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ session('pesan') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex align-items-center mt-3">
                        <h5 class="card-header">Data Pembayaran</h5>
                        <form action="{{ route('admin.pembayaran.index') }}" method="GET">
                            <div class="d-flex ms-5">
                                <label for="payment_status" class="ms-3">Pilih Tipe Pembayaran</label>
                                <select name="payment_status" id="payment_status" class="form-control ms-3">
                                    <option value="">----</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Pembayaran Online">Pembayaran Online</option>
                                </select>
                                <button type="submit" class="btn btn-primary ms-3">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Wali</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Tanggal Konfirmasi</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayarans as $index => $pembayar)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $pembayar->wali->name ?? 'Tidak Ada Pengirim/Bayar Online' }}</strong>
                                            </td>
                                            </td>
                                            <td>
                                                @if ($pembayar->payment_links == 'Cash')
                                                    Cash
                                                @elseif ($pembayar->payment_links == NULL)
                                                    Bank
                                                @elseif ($pembayar->payment_links != NULL)
                                                    Pembayaran Online
                                                @endif
                                            </td>
                                            <td>
                                                @if (strtolower($pembayar->payment_status) === 'berhasil')
                                                    Dikonfirmasi
                                                @elseif ($pembayar->payment_status == 'PENDING')
                                                    Belum Di Konfirmasi
                                                @endif
                                            </td>
                                            <td>
                                                @if (strtolower($pembayar->payment_status) === 'berhasil')
                                                    {{ $pembayar->updated_at ? $pembayar->updated_at->format('d/m/Y') : '-' }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.pembayaran.detail', $pembayar->id) }}"
                                                    class="btn btn-warning me-2"><i class='tf-icons bx bx-detail'></i></a>
                                                    <form method="POST" action="{{ route('admin.pembayaran.destroy', $pembayar->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger show_confirm" type="submit"><i class="bx bx-trash"></i></button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"
        integrity="sha512-mJQ9oQHzLM2zXe1cwiHmnMddNrmjv1YlaKZe1rM4J7q8JTnNn9UgeJVBV9jyV/lVGdXymVx6odhgwNZjQD8AqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js"
        integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).on('click', '.show_confirm', function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                    title: 'Yakin?',
                    text: "Kamu Akan Menghapus Data Pembayaran!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Terhapus!',
                            'Kamu telah menghapus Data Pembayaran!!.',
                            'success'
                        )
                    }
                });
            });
        </script>
        
@endpush

