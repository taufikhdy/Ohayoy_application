@extends('layouts.main')

@section('title', 'ohayoy-dashboard')

@section('content')

    <div class="content">
        <div class="container-w2">
            <div class="">
                <h3 class="element-title">Pesanan Masuk</h3>

                {{-- @foreach ($pesanan as $order)
                    <div class="card-order">
                        <div class="card-title">
                            <h3>Pesanan {{ $order->meja->nama_meja }} ( {{ $order->meja->username }} )</h3>
                        </div>

                        <div class="table-container">
                            <table class="order-data">
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Jumlah</th>
                                </tr>

                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->menu->nama_menu }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                    </tr>
                                @endforeach
                                <tr class="total">
                                    <td>Total Harga</td>
                                    <td>{{ 'Rp. ' . number_format($order->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card-controll flex align-center flex-end">
                            <form action="{{ route('kasir.konfirmasiPesanan') }}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" id="" value="{{ $order->id }}">
                                <button type="submit" class="btn-primary">Konfirmasi Pesanan</button>
                            </form>
                        </div>
                    </div>
                @endforeach --}}

                <div id="orders"></div>
            </div>

            <div class="">
                <h3 class="element-title">Konfirmasi Pelanggan Selesai</h3>

                {{-- @foreach ($order_selesai as $meja => $orders)
                    <div class="card-order">
                        <h3 class="card-title">Pesanan {{ $orders->first()->meja->nama_meja }}</h3>
                        <div class="table">
                            <table class="order-data">
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                                @foreach ($orders as $order)
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="text-left text-wrap">{{ $item->menu->nama_menu }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr class="total">
                                    <td colspan="2" class="text-center">Subtotal</td>
                                    <td>Rp {{ number_format($orders->sum('total_harga'), 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card-controll flex align-center flex-end">
                            <form action="{{ route('kasir.pelangganSelesai') }}" method="post">
                                @csrf
                                <input type="hidden" name="meja_id" id=""
                                    value="{{ $orders->first()->meja->id }}">
                                <button type="submit" class="btn-primary">Konfirmasi Pembayaran</button>
                            </form>
                        </div>
                    </div>
                @endforeach --}}

                <div id="confirm-payment"></div>
            </div>
        </div>


        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadPesanan() {
                $.ajax({
                    url: '/kasir/pesanan/data', // sesuaikan dengan route JSON kamu
                    method: 'GET',
                    success: function(res) {
                        let html = '';

                        $.each(res.pesanan, function(i, order) {
                            html += `
                <div class="card-order">
                        <h3 class="card-title">Pesanan ${order.meja.nama_meja} (${order.meja.username})</h3>


                    <div class="table-container">
                        <table class="order-data">
                            <tr>
                                <th>Nama Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>`;

                            $.each(order.items, function(j, item) {
                                html += `
                        <tr>
                            <td class="text-left text-wrap">${item.menu.nama_menu}</td>
                            <td>${item.jumlah}</td>
                            <td>Rp. ${Number(item.menu.harga).toLocaleString('id-ID')}</td>
                        </tr>`;
                            });

                            html += `

                        </table>
                    </div>

                    <div class="card-controll flex align-center flex-end">
                        <form action="/kasir/pesanan/konfirmasi_pesanan" method="post">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="order_id" value="${order.id}">
                            <button type="submit" class="btn-primary">Konfirmasi Pesanan</button>
                        </form>
                    </div>
                </div>`;
                        });

                        $('#orders').html(html);
                    }
                });
            }

            // panggil sekali saat halaman load
            loadPesanan();

            setInterval(loadPesanan, 5000);

            function loadPesananSelesai() {
                $.ajax({
                    url: '/kasir/pesanan/dataSelesai', // route JSON untuk pesanan selesai
                    method: 'GET',
                    success: function(res) {
                        let html = '';

                        $.each(res.order_selesai, function(meja_id, orders) {
                            // ambil meja dari order pertama
                            let mejaNo = orders[0].meja.nama_meja;
                            let mejaNama = orders[0].meja.username;

                            html += `
                <div class="card-order">
                    <h3 class="card-title">Pesanan ${mejaNo} ( ${mejaNama} )</h3>
                    <div class="table-container">
                        <table class="order-data">
                            <tr>
                                <th>Nama Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>`;

                            let subtotal = 0;

                            $.each(orders, function(i, order) {
                                $.each(order.items, function(j, item) {
                                    subtotal += item.subtotal;
                                    html += `
                            <tr>
                                <td class="text-left text-wrap">${item.menu.nama_menu}</td>
                                <td>${item.jumlah}</td>
                                <td>Rp. ${Number(item.subtotal).toLocaleString('id-ID')}</td>
                            </tr>`;
                                });
                            });

                            html += `
                    <tr class="total">
                        <td colspan="2" class="text-center">Subtotal</td>
                        <td>Rp. ${Number(subtotal).toLocaleString('id-ID')}</td>
                    </tr>
                        </table>
                    </div>

                    <div class="card-controll flex align-center flex-end">
                        <form action="/kasir/pesanan/konfirmasiPelangganSelesai" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="meja_id" value="${meja_id}">
                            <div class="flex gap10">
                            <input type="number" name="uang" placeholder="Bayar Tunai" required>
                            <button type="submit" class="btn-primary">Konfirmasi pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>`;
                        });

                        $('#confirm-payment').html(html);
                    }
                });
            }

            // panggil sekali saat halaman load
            loadPesananSelesai();

            // auto refresh tiap 10 detik (opsional)
            setInterval(loadPesananSelesai, 10000);
        </script>

    @endsection

    {{-- <tr class="total">
        <td colspan='2'>Total Harga</td>
        <td>Rp. ${Number(order.total_harga).toLocaleString('id-ID')}</td>
    </tr> --}}
