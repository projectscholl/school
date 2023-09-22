@extends('layouts.master')

@section('content')
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Activity /</span>
                    Activity
                </h4>
                <!-- Bordered Table -->

                <div class="card">
                    <h5 class="card-header">Data Activity Tables</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-white" width="1%">No</th>
                                        <th class="text-white">User</th>
                                        <th class="text-white">Event</th>
                                        <th class="text-white">Before</th>
                                        <th class="text-white">After</th>
                                        <th class="text-white">Description</th>
                                        <th class="text-white">Log At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($log as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->causer->name }}</td>
                                            <td>{{ $value->event }}</td>
                                            <td>
                                                @if (@is_array($value->changes['old']))
                                                    @foreach ($value->changes['old'] as $keys => $itemChange)
                                                        {{ $keys }} : {{ $itemChange }} <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if (@is_array($value->changes['attributes']))
                                                    @foreach ($value->changes['attributes'] as $keys => $itemChange)
                                                        {{ $keys }} : {{ $itemChange }} <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $value->description }}</td>
                                            <td>{{ $value->created_at->format('d-m-Y H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
    </div>
@endsection
