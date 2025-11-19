<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <title>Ohayo-Customer</title>
    <link rel="stylesheet" href="{{ asset('css/login.css?v6++') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}">
</head>

<body>

    <div class="container">
        <img src="{{ asset('images/banner.jpeg') }}" alt="" class="object-fit">

        <div class="formcs toTop">

            <form action="{{ route('customer.username.valid') }}" method="POST">
                @csrf
                <div class="input">
                    <div>
                        <div>Selamat Datang Di Ohayoy</div>
                        <h1>Kamu berada di {{ Auth::guard('meja')->user()->nama_meja }}</h1>
                        <div class="text-small">Yuk, isi nama pengguna dengan nama pilihan kamu, nama pengguna  ini digunakan untuk nama penerima pesanan kamu nanti </p>
                    </div>

                    <br>

                    <input type="text" name="username" id="" placeholder="Nama pengguna : minimal 5 karakter"
                        autocomplete="off" minlength="5" maxlength="12">
                    <input type="submit" name="" id="" value="Masuk">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
