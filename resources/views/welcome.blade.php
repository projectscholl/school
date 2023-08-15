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

<body style="background-image : url('public/sneat/assets/img/backgrounds/sekolah.jpg'); background-repeat:no-repeat; background-size:cover;">
    <div class="container-fluid" style="background-color:#f7ecf2;">
        <div class="row p-3">
            <div class="d-flex align-items-center">
                <img src="{{ asset('sneat') }}/assets/img/favicon/png-clipart-computer-icons-gear-eps-zip-miscellaneous-vector-logo.png" alt="" width="50px;">
                <h2 class="ms-3">SMK TADIKA</h2>

            </div>
        </div>
    </div>
    <div class="container">
        <h1 style="font-family: Public sans, serif; font-weight:700;" class="">Selamat Datang di Smk Tadika</h1>

        <a href="{{ route('login') }}">Admin Login</a>
        <a href="{{ route('login-wali') }}">Wali Murid Login</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
