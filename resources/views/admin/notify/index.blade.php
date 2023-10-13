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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Setting Notify /</span>
                    Notify
                </h4>
                <div class="card ">
                    <div class="card-header">
                        <h5>Data Notification</h5>
                        <span>* Silahkan Untuk Menganti pesan yang Diinginkan. *</span>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            @foreach ($notify as $notif)
                                <div class="mb-3 col-md-12 shadow-sm py-3 rounded">
                                    <form action="{{ route('admin.pesan-whatsaap.update', $notif->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="" class="mb-2">Notification Tagihan</label>
                                        <input type="text" name="notif" value="{{ $notif->notif }}"
                                            class="form-control mb-3">
                                        <button class="btn btn-primary">Submit</button>

                                    </form>
                                </div>
                            @endforeach
                            @foreach ($notify2 as $notif2)
                                <div class="mb-3  col-md-12 shadow-sm py-3 rounded">
                                    <form action="{{ route('admin.pesan-whatsaap.update', $notif2->id) }} "method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="" class="mb-2">Notification Tenggat</label>
                                        <input type="text" name="notif" value="{{ $notif2->notif }}"
                                            class="form-control mb-3">
                                        <button class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            @endforeach
                            @foreach ($notify3 as $notif3)
                                <div class="mb-3 col-md-12 p-2 shadow-sm py-3 rounded">
                                    <form action="{{ route('admin.pesan-whatsaap.update', $notif3->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="" class="mb-2">Notification Confirmation</label>
                                        <input type="text" name="notif" value="{{ $notif3->notif }}"
                                            class="form-control mb-3">
                                        <button class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            @endforeach
                            @foreach ($notify4 as $notif4)
                                <div class="mb-3 col-md-12 p-2 shadow-sm py-3 rounded">
                                    <form action="{{ route('admin.pesan-whatsaap.update', $notif4->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="" class="mb-2">Waktu Notification sebelum tenggat</label>
                                        <select name="notif" class="form-control mb-3" id="">
                                            <option value="">--Pilih--</option>
                                            <option value="-5 days" {{ $notif4->notif == '-5 days' ? 'selected' : '' }}>5
                                                hari
                                                sebelum tenggat</option>
                                            <option value="-10 days" {{ $notif4->notif == '-10 days' ? 'selected' : '' }}>10
                                                hari
                                                sebelum tenggat</option>
                                            <option value="-15 days" {{ $notif4->notif == '-15 days' ? 'selected' : '' }}>15
                                                hari
                                                sebelum tenggat</option>
                                        </select>
                                        <div>
                                            @error('notif')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endpush
