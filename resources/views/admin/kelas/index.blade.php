@extends('layouts.master')

@section('title', 'Kelas')
@section('content')
    <div class="layout-page">
        <x-navbar></x-navbar>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    @if (session('edit'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('edit') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                 
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                 
                    @endif
                    <div class="card-header">
                        <h5>
                            Table Data Kelas</h5>
                        <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">Tambah kelas</a>

                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
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
                                @foreach ($kelas as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->angkatans->tahun }}</td>
                                        <td>{{ $item->jurusans->nama }}</td>
                                        <td>
                                            <a href="{{ route('admin.kelas.edit', $item->id) }}" class="btn btn-warning"><i
                                                    class='bx bx-edit-alt'></i></a>
                                        </td>
                                    </tr>
                            </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
