@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    @include('layouts.sidebar')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">Data Kelas</div>
                    <table class="table" id="myTables">

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
