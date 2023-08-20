@extends('layouts.master')

@section('title', 'Bayar')
@section('content')
    @include('layouts.sidebar')
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
                                <tr>
                                    <td>Juni</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>July</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agustus</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oktober</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>November</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Desember</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Januari</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>February</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maret</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mei</td>
                                    <td>200.000</td>
                                    <td>
                                        <input type="checkbox" data-select name="" id="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('wali.tagihan.detail2') }}" class="btn btn-success mt-3 w-25">Bayar</a>
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
