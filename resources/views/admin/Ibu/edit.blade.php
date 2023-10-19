@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bordered Table -->
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit Data Ibu /</span>
                    Ibu
                </h4>
                <div class="card">
                    {{-- @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                 
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('delete') }}!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                    
                    @endif --}}
                    <div class="card-header">
                        <h5>EDIT</h5>

                        @if ($wali == true)
                        @elseif ($wali == false)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Tambah Menjadi Wali murid
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Anda Perlu Menambahkan
                                                Password Untuk menjadikan wali murid *</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.IbuMurid.role', $ibu->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="form-group mb-3">
                                                    <label for="">Masukkan Password <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" name="password" class="form-control">
                                                    <input type="hidden" name="name" class="form-control"
                                                        value="{{ $ibu->name }}">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <form action="{{ route('admin.IbuMurid.update', $ibu->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $ibu->name }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $ibu->email }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Telepon</label>
                                    <input type="number" name="telepon" id="telepon" class="form-control"
                                        value="{{ str_replace('62', '0', $ibu->telepon) }}">
                                    @error('telepon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Masukkan Agama</label>
                                    <select name="agama" id="" class="form-control">
                                        <option selected>--Pilih--</option>
                                        <option value="Islam" {{ $ibu->agama == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{ $ibu->agama == 'Kristen' ? 'selected' : '' }}>
                                            Kristen
                                        </option>
                                        <option value="Katolik" {{ $ibu->agama == 'Katolik' ? 'selected' : '' }}>
                                            Katolik
                                        </option>
                                        <option value="Hindu" {{ $ibu->agama == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha" {{ $ibu->agama == 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu" {{ $ibu->agama == 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu
                                        </option>
                                        <option value="Ateis" {{ $ibu->agama == 'Ateis' ? 'selected' : '' }}>Ateis
                                        </option>
                                    </select>
                                    @error('agama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control" placeholder="kuli"
                                        value="{{ $ibu->pekerjaan }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Masukkan Pendidikan</label>
                                    <select name="pendidikan" id="" class="form-control">
                                        <option selected>--Pilih--</option>
                                        <option value="SD" {{ $ibu->pendidikan == 'SD' ? 'selected' : '' }}>SD
                                            -sederajat</option>
                                        <option value="SMP" {{ $ibu->pendidikan == 'SMP' ? 'selected' : '' }}>SMP
                                            -sederajat</option>
                                        <option value="SMA" {{ $ibu->pendidikan == 'SMA' ? 'selected' : '' }}>SMA
                                            -sederajat</option>
                                        <option value="S1" {{ $ibu->pendidikan == 'S1' ? 'selected' : '' }}>S1
                                        </option>
                                        <option value="S2" {{ $ibu->pendidikan == 'S2' ? 'selected' : '' }}>S2
                                        </option>
                                        <option value="S3" {{ $ibu->pendidikan == 'S3' ? 'selected' : '' }}>S3
                                        </option>
                                    </select>
                                    @error('pendidikan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 d-flex flex-column">
                                    <label for="" class="form-label">Image</label>
                                    <img src="{{ asset('storage/image/' . $ibu->image) }}" alt="" width="100"
                                        class="mb-3 rounded" id="output">
                                    <input type="file" name="image"
                                        class="form-control @error('image')
                                        is-invalid
                                    @enderror"
                                        onchange="loadFile(event)">
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG.
                                        Max size of 2Mb
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{ $ibu->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.IbuMurid.index') }}" class="btn btn-warning">Back</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
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
        @elseif (Session::has('error'))
            toastr.error('{{ Session::get('error') }}')
        @endif
    </script>
@endpush
