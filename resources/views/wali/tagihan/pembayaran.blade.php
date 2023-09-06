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
                <div class="card">
                    <h5 class="card-header">Pilih Bayar</h5>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-white">Bulan</th>
                                    <th class="text-white">Total</th>
                                    <th class="text-white d-flex">Pilih<input class="ms-2" type="checkbox" id="selectAll"></th>
                                </tr>
                            </thead>
                            <form action="{{ route('wali.tagihan.pembayaran.store', $tagihan->id) . '?idmurid=.$murid->id' }}" method="GET">
                                <tbody>
                                    @foreach ($bulan as $bulans)
                                        <tr>
                                            <td>{{ $bulans->mounth }}</td>
                                            <td>Rp {{ number_format($bulans->amount) }}</td>
                                            <td> 
                                                <input type="checkbox" data-select name="amount[{{ $bulans->id }}]" value="{{ $bulans->id }}" data-id="{{ $bulans->id }}" >
                                            </td>                   
                                        </tr>
                                    @endforeach
                                </tbody>
                                <button type="submit" class="btn btn-success mt-3 w-25">Pilih Pembayaran</button>
                            </form>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mt-3">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </ul>
                                </div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <script>

                const selectedData = [];

                const checkboxes = document.querySelectorAll('input[data-select]');

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        if (this.checked) {
                            const rowId = this.getAttribute('data-id');
                            const month = document.querySelector(`tr[data-id="${rowId}"] td:first-child`).textContent;
                            const amount = document.querySelector(`tr[data-id="${rowId}"] td:nth-child(2)`).textContent;

                            // Tambahkan nilai ke dalam objek selectedData
                            selectedData.push({ month, amount });

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