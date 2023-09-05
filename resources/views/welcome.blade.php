@php
    $instansi = \App\Models\Instansi::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <title>Document</title>
</head>

<body
    style="background-image : url('storage/image/background.jpg'); background-repeat:no-repeat; background-size:cover; ">
    <div class="container-fluid sticky-top d-flex align-items-center justify-content-between"
        style="background-color:rgba(0,0,0,0.5);">
        <div class="row p-2">
            <div class="d-flex align-items-center ps-5">
                <img src="{{ asset('storage/image/' . $instansi->logo) }}" alt="" width="50">
                <h2 class="ms-3 text-light" style="font-family: Public sans, serif;">SMK TADIKA</h2>
            </div>
        </div>
        <div>
            @guest
            @else
                <div class="d-flex">
                    <a href="{{ Auth::user()->role == 'ADMIN' ? route('admin.dashboard') : route('wali.dashboard') }}"
                        class="btn btn-outline-light" style="font-family: Public sans, serif;">Dashboard</a>

                    <a class="btn btn-light ms-3" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">

                        <span class="align-middle">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button class="btn btn-light ms-3" style="font-family: Public sans, serif;">Logout</button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
    <div class="container-fluid
                        position-relative"
        style="background-color: rgba(0,0,0,0.5); height:100vh;">
        <div class="position-absolute" style="top:25%; left:10%">
            <p class="text-light" style="font-family: Public sans, serif;">Welcome To SMK Tadika</p>
            <h1 style="font-family: Public sans, serif; font-weight:700;" class="text-light ">Live as if you
                were to
                die
                tomorrow <br>Learn as if you were to live forever.
            </h1>
            <div class="d-flex mt-4 align-items-center">
                <a href="{{ route('login-wali') }}" class="btn btn-light" style="font-family: Public sans, serif;">LOGIN
                    WALI
                    MURID</a>
                <a href="" class="btn btn-outline-light ms-4" style="font-family: Public sans, serif;">DAFTAR
                    MURID</a>
            </div>
        </div>
        <footer class="fixed-bottom w-100  d-flex align-items-center bg-black justify-content-center"
            style="background-color:rgba(0, 0, 0, 0);">
            <a href="" class="text-light text-decoration-none"
                style="font-family: Public sans, serif;">admin@gmail.com</a>
            <hr style="width:3px;height:30px; background-color:rgb(4, 232, 205);" class="mx-2">
            <a class="text-light" style="font-family: Public sans, serif;">Tlp : 0863712326</a>
            @guest
                <hr style="width:3px;height:30px; background-color:rgb(4, 232, 205);" class="mx-2">

                <a href="{{ route('login') }}" class="text-light text-decoration-none"
                    style="font-family: Public sans, serif;">Login
                    Admin</a>
                <hr style="width:3px;height:30px; background-color:rgb(4, 232, 205);" class="mx-2">

                <a href="{{ route('login-wali') }}" class="text-light text-decoration-none"
                    style="font-family: Public sans, serif;">Login
                    Wali Murid</a>


            @endguest
            <hr style="width:3px;height:30px; background-color:rgb(4, 232, 205);" class="mx-2">
            <a href="" class="text-danger text-decoration-none" style="font-family: Public sans, serif;">@2023
                Copyright by Tadika</a>



        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
