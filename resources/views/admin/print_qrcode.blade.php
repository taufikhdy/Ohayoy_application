<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ohayoy QR Print</title>
    <link rel="stylesheet" href="{{ asset('css/print_qr.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}">
</head>

<body>

    <a href="{{ route('admin.meja') }}" class="back">Batal</a>

    <div class="info">
        <button onclick="print()"><i class="ri-print-fill" style="color:"></i> cetak</button>
        <div class=""><i class="ri-information-2-fill" style="color:"></i> Ukuran Kerta A4</div>
    </div>

    @php
        $chunks = array_chunk($qrcode, 4);
    @endphp

    @foreach ($chunks as $data)
        <div class="print-area">
            @foreach ($data as $card)
                <div class="card">
                    <h1 class="title">
                        <i class="ri-restaurant-fill"></i>
                        <br>
                        Scan Me
                    </h1>
                    <div class="qr">
                        {{ $card['qr'] }}
                    </div>
                    <h1 class="title">{{ $card['meja']['nama_meja'] }}</h1>

                    <div class="media">
                        <div class="link-box">
                            <i class="ig ri-instagram-line"></i> | tauwfiik.hdy
                        </div>
                        <div class="link-box">
                            <i class="ri-github-fill git"></i> | taufik.hdy
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Jika kurang dari 4, isi dengan kotak kosong --}}
            @for ($i = count($chunks); $i < 4; $i++)
                <div class="card" style="background:none;border:0"></div>
            @endfor
        </div>
    @endforeach

    <script>
        print();
    </script>
</body>

</html>
