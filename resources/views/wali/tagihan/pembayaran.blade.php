@extends('layouts.master')

@section('title', 'Bayar')
@section('content')
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <h5 class="card-header mb-2">Tagihan <strong>{{ $murid->name }}</strong></h5>
                    <div class="card-body">
                        <h5 class=" m-0 me-2 mb-3">{{ $tagihan->nama_biaya }}</h5>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-white">Bulan</th>
                                    <th class="text-white">Total</th>
                                    <th class="text-white">STATUS</th>
                                    <th class="text-white">TENGGAT</th>
                                    <th class="text-white d-flex">Pilih<input class="ms-2" type="checkbox" id="selectAll">
                                    </th>
                                </tr>
                            </thead>
                            <form id="pembayaran"
                                action="{{ route('wali.tagihan.pembayaran.bank', ['id' => $tagihan->id, 'idmurid' => $murid->id]) }}"
                                method="POST">
                                @csrf
                                <tbody>
                                    @foreach ($bulan as $bulans)
                                        @php
                                            $tagihanDetails = App\Models\TagihanDetail::where('id_tagihan', $bulans->id)
                                                ->where('id_murids', $murid->id)
                                                ->get();
                                        @endphp
                                        @foreach ($tagihanDetails as $tagihanDetail)
                                            <tr>
                                                <td>
                                                    @if ($tagihanDetail->end_date)
                                                        {{ \Carbon\Carbon::createFromFormat('d-m', $tagihanDetail->end_date)->format('F') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>                                                                                                
                                                <td>Rp {{ number_format($tagihanDetail->jumlah_biaya) }}</td>
                                                <td
                                                    class="ms-2 mt-2 badge bg-label-{{ $tagihanDetail->status == 'BELUM' && $tagihanDetail->end_date < now()
                                                        ? 'warning'
                                                        : ($tagihanDetail->status == 'SUDAH'
                                                            ? 'success'
                                                            : 'danger') }}">
                                                    <strong>
                                                        @if ($tagihanDetail->status == 'BELUM' && $tagihanDetail->end_date < now())
                                                            NUNGGAK
                                                        @elseif ($tagihanDetail->status == 'SUDAH')
                                                            {{ $tagihanDetail->status }}
                                                        @else
                                                            {{ $tagihanDetail->status }}
                                                        @endif
                                                    </strong>
                                                </td>
                                                <td>
                                                    @if ($tagihanDetail->end_date)
                                                        {{ \Carbon\Carbon::createFromFormat('d-m', $tagihanDetail->end_date)->format('d/m') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>                                 
                                                <td>
                                                    <input type="checkbox" data-select
                                                        name="amount[{{ $tagihanDetail->id }}]"
                                                        value="{{ $tagihanDetail->id }}"
                                                        {{ $tagihanDetail->status == 'SUDAH' ? 'disabled' : '' }}
                                                        data-id="{{ $tagihanDetail->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </form>
                        </table>
                        <button form="pembayaran" type="submit" class="btn btn-success mt-3 w-25">Pilih Pembayaran</button>
                    </div>
                </div>
            </div>
            <script>
                const selectedData = [];

                const checkboxes = document.querySelectorAll('input[data-select]');

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            const rowId = this.getAttribute('data-id');
                            const month = document.querySelector(`tr[data-id="${rowId}"] td:first-child`)
                                .textContent;
                            const amount = document.querySelector(`tr[data-id="${rowId}"] td:nth-child(2)`)
                                .textContent;

                            // Tambahkan nilai ke dalam objek selectedData
                            selectedData.push({
                                month,
                                amount
                            });

                            // Untuk melihat isi objek selectedData saat ini
                            console.log(selectedData);
                        }
                    });
                });

                document.addEventListener("DOMContentLoaded", function() {
                    const selectAllCheckbox = document.querySelector("#selectAll");
                    const checkboxes = document.querySelectorAll("[data-select]");

                    selectAllCheckbox.addEventListener("change", function() {
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = selectAllCheckbox.checked;
                        });
                    });

                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener("change", function() {
                            if (!checkbox.checked) {
                                selectAllCheckbox.checked = false;
                            } else if (
                                [...checkboxes].every(checkbox => checkbox.checked)
                            ) {
                                selectAllCheckbox.checked = true;
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
@endsection
