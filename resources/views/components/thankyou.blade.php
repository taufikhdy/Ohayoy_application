<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <title>Ohayoy Thankyou Page 💖</title>

    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'montserrat';
            color: hsl(0, 0%, 20%)
        }

        a {
            text-decoration: none;
            color: hsl(218, 95%, 48%);
        }

        h3 {
            color: hsl(218, 95%, 48%);
        }

        .text-center {
            text-align: center;
        }

        .text-small {
            font-size: small;
        }

        .title {
            padding: 10px 0px;
        }

        .container {
            /* padding: 15% 0px 0px 0px; */
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background-color: #fff;
            padding: 0px 10%;
        }

        .mt40 {
            margin-top: 40px;
        }

        .badge {
            display: flex;
            justify-content: center;
            justify-content: center;
            width: 100%;
            gap: 5px;
        }

        .badge a {
            font-size: 2.5em
        }

        .ig {
            color: #E1306C;
        }

        .git {
            color: #181717;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center">
            <h1>\(@^0^@)/</h1>
            <br>
            <h3>Hi, ga kerasa nih udah selesai aja makannya,</h3>
            <br>
            {{-- <h4>gimana udah kenyang?!</h4> --}}
            <p>makasi yaa udah makan disini, semoga jadi pengalaman terbaik buat kamu!</p>

            <div class="mt40">
                <p class="title text-small">Yuk, ikuti terus sosmed kita yaa, <br> jangan sampe ketinggalan info
                    terbaru!</p>
                <div class="badge">
                    <a href="https://www.instagram.com/tauwfiik/" class="link-box">
                        <i class="ig ri-instagram-line"></i>
                    </a>

                    <a href="https://github.com/taufikhdy" class="link-box">
                        <i class="ri-github-fill git"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
