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
                            <tbody>
                                @foreach ($bulan as $bulans)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $bulans->start_date)->format('F') }}</td>
                                        <td>Rp {{ number_format($bulans->amount) }}</td>
                                        <td>
                                            <input type="checkbox" data-select name="selected_months[]" value="{{ $bulans->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                        <a href="{{ route('wali.tagihan.pilih_pembayaran') }}" class="btn btn-success mt-3 w-25">Pilih Pembayaran</a>
                    </div>
                </div>
            </div>
            <script>
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