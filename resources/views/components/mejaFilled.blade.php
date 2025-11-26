<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ohayoy Filled Page</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'montserrat';
            color: hsl(0, 0, 20%)
        }

        a {
            text-decoration: none;
            color: hsl(218, 95%, 48%);
        }

        .text-center {
            text-align: center;
        }

        .container {
            /* padding: 15% 0px 0px 0px; */
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background-color: #fff;
            position: relative;
            z-index: 1;

        }

        .btn-blue {
            background-color: hsl(218, 95%, 48%);
            border: 1px solid hsl(218, 95%, 48%);
            color: white;
            border-radius: 4px;
            padding: 6px;
            cursor: pointer;
            font-size: small;
            text-wrap: nowrap;
            font-weight: 600;

        }

        .w80 {
            width: 80%
        }

        .message {
            position: absolute;
            z-index: 99;
            background: hsla(0, 0%, 0%, 0.8);
            color: white;
            text-align: center;
            padding: 10px;
            /* left: 50%; */
            /* transform: translateX(-50%); */
            /* transform: translateY(100%) */
            /* bottom: 0; */
            bottom: 50%;
            animation: toTop .5s;
        }

        @keyframes toTop {
            0%{
                transform: scale(0);
                opacity: 0;
                /* bottom: 0; */
            }

            100% {
                transform: scale(1);
                opacity: 1;
                /* bottom: 50% */
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center w80">
            <h1>(┬┬﹏┬┬)</h1>
            <br>
            <h3>Ups! Meja lagi diisi</h3>
            <br>
            <h3>Yuk! <a href="">Cari meja lain</a></h3>
            <br>
            <p>
            <h4>atau</h4>
            <br>
            Klik tombol "request reset" untuk mengirim permintaan mengosongkan jika status meja terisi tapi meja sudah
            kosong / tidak ada orang. <br>
            Sambil menunggu coba refresh/reload halaman untuk beberapa saat 🤗.
            <br>
            Kami mohon maaf 🙏
            <br>
            <br>
            <form action="{{ route('resetRequest', $id) }}" method="post">
                @csrf
                <input type="hidden" name="meja_id" id="" value="{{ $id }}">
                <button type="submit" class="btn-blue">Request Reset</button>
            </form>
            </p>
        </div>

        @if (session('success'))
            <div class="message" id="message">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('message');
            if (flash) {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 300)
            }
        }, 3000);
    </script>

</body>

</html>
