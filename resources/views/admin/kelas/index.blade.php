@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Table Data Kelas</h5>
                        <a href="" class="btn btn-primary">Tambah kelas</a>

                    </div>
                    <div class="card-body">
                        <table class="table" id="myTables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Angkatan</th>
                                    <th>Jurusan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>XI</td>
                                    <td>IPA 1</td>
                                    <td>2022</td>
                                    <td>
                                        <a href="" class="btn btn-warning"><i class='bx bx-edit-alt'></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
