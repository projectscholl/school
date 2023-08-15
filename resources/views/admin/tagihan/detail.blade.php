@extends('layouts.master')

@section('content')
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bordered Table -->
                        <div class="card">
                            <h5 class="card-header">Detail Tagihan</h5>
                            <div class="card-body">
                                <div>ID : 1</div>
                                <hr>
                                <div>NAMA : Ahmad Sawiji</div>
                                <hr>
                                <div>Dibuat : 1/12/2023 </div>
                                <hr>
                                <div>Di Update : 1/1/2024</div>
                                <hr>
                            </div>                            
                        </div>
                    </div>
                    <!--/ Bordered Table -->
                </div>
            </div>
        </div>
    </div>
@endsection
