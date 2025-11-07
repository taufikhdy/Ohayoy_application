@extends('layouts.customer')

@section('title', 'ohayoy-order')

@section('content')


    @if (session('success'))
        <div class="message success" id="message">
            {{ session('success') }}
        </div>
    @endif

    <div class="keranjang">

        @if ($orders->isEmpty())
            <div class="text-block text-center">
                <h5>Kamu belum pesan menu.</h5>
                <br>
                <h1> ヾ(≧▽≦*)o </h1>
                <br>
                <h5>Yuk cari menu pilihan kamu dan pesan <a href="{{ route('customer.menu') }}" class="primary">sekarang!</a>
                </h5>
            </div>
        @else
            <form action="{{ route('customer.orderMenu') }}" method="POST">
                <div class="container-w4 gap20">
                    @csrf
                    @foreach ($orders as $order)
                        @foreach ($order->items as $i)
                            <div class="menu-box gap20">
                                <a href="{{ route('customer.detailMenu', $i->menu->id) }}">
                                    <div class="gambar">
                                        <img src="{{ asset('storage/' . $i->menu->foto) }}" alt=""
                                            class="object-fit">
                                    </div>

                                    <div class="flex flex-between align-center w100">
                                        <div class="w100">
                                            <h3 class="title mb10">{{ $i->menu->nama_menu }}</h3>

                                            <div class="flex align-center gap10">
                                                <p class="badge-sm">{{ $i->menu->kategori->nama_kategori }}</p>
                                                <div class="">
                                                    @if ($order->status === 'pending')
                                                        <div class="pending text-small">{{ $order->status }}</div>
                                                    @elseif ($order->status === 'ordered')
                                                        <div class="ordered text-small">{{ $order->status }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <h4 class="mt10">Pesan {{ $i->jumlah }}</h4>

                                            <h4 class="mt10">Total
                                                {{ 'Rp. ' . number_format($i->subtotal, 0, ',', '.') }}</h4>
                                </a>
                            </div>

                </div>
    </div>
    @endforeach
    @endforeach

    </form>
    </div>
    @endif

    <div class="bottom-navbar text-center left w100">
        <h3>Total Bayar {{ 'Rp. ' . number_format($total_bayar, 0, ',', '.') }}</.>
    </div>
    </div>

@endsection
