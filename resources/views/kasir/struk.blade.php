<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ohayoy Receipt</title>
    <link rel="stylesheet" href="{{ asset('css/struk.css?v2+') }}">
</head>

<body>

    <div class="container">
        <div class="">
            <div class="box">
                <div class="title">
                    <h2>{{ $toko->nama_toko }}</h2>
                </div>

                <div class="data-address">
                    <p class="text-small text-center">{{ $toko->tagline_toko }}</p>
                    <br>
                    <p class="address">{{ $toko->alamat_toko }}</p>
                    <p class="site">{{ $toko->website_toko }}</p>
                </div>

                @foreach ($order_item as $meja => $order)
                    <div class="data">
                        <div class="data-left">
                            <p>Order #{{ $transaksi->order_id }}</p>
                            <p>Date {{ $transaksi->created_at->format('d-m-Y') }}</p>
                        </div>

                        <div class="data-right">
                            <p>kasir/{{ $transaksi->nama_kasir }}</p>
                            <p>{{ $transaksi->waktu }}</p>
                        </div>
                    </div>

                    <div class="db-data">
                        <table>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>

                            @foreach ($order as $ord)
                                @foreach ($ord->items as $item)
                                    <tr>
                                        <td>{{ $item->menu->nama_menu }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ 'Rp. ' . number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            @endforeach

                            <tr>
                                <td colspan="2" class="border-top subtotal">Subtotal</td>
                                <td class="border-top subtotal text-right">
                                    {{ 'Rp. ' . number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                            </tr>

                            <tr>
                                <td colspan="2" class="border-top subtotal">
                                    <h4>Kembalian</h4>
                                </td>
                                <td class="border-top subtotal text-right">
                                    <h4>{{ 'Rp. ' . number_format($kembalian, 0, ',', '.') }}</h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h3 class="text-center">{{ $toko->ucapan }}</h3>
                    <div class="form">
                        <form action="{{ route('kasir.resetOrder') }}" method="post">
                            @csrf
                            <input type="hidden" name="meja_id" id="" value="{{ $meja }}">
                            <button type="submit" class="btn-primary">Konfirmasi</button>
                        </form>
                        <button onclick="print()" class="btn-primary">Cetak Struk</button>
                    </div>
            </div>
            @endforeach

        </div>
    </div>

    <script>
        print();
    </script>
</body>

</html>
