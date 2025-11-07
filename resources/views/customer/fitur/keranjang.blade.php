@extends('layouts.customer')

@section('title', 'ohayoy-keranjang')

@section('content')


    <div class="keranjang">

        @if (!$items)
            <div class="text-block text-center">
                <h5>Belum ada menu yang kamu tambahkan ke keranjang.</h5>
                <br>
                <h1> ヾ(≧▽≦*)o </h1>
                <br>
                <h5>Yuk cari menu pilihan kamu <a href="{{ route('customer.menu') }}" class="primary">sekarang!</a></h5>
            </div>
        @else
            <form action="{{ route('customer.orderMenu') }}" method="POST">
                <div class="container-w4 gap20">
                    @csrf
                    @foreach ($items as $i)
                        <div class="menu-box gap20">
                            <a href="{{ route('customer.detailMenu', $i->menu->id) }}">
                                <div class="gambar">
                                    <img src="{{ asset('storage/' . $i->menu->foto) }}" alt="" class="object-fit">
                                </div>

                                <div class="flex flex-between align-center w100">
                                    <div class="w100">
                                        <h3 class="title mb10">{{ $i->menu->nama_menu }}</h3>
                                        <p class="badge-sm">{{ $i->menu->kategori->nama_kategori }}</p>
                                        <h3 class="mt15">Harga {{ 'Rp. ' . number_format($i->menu->harga, 0, ',', '.') }}</h3>

                            </a>
                            <div class="flex flex-end w100">
                                <div class="item-order">
                                    <input type="number" name="jumlah[{{ $i->id }}]" value="{{ $i->jumlah }}"
                                        min="1">
                                    <input type="checkbox" name="items[{{ $i->id }}]" value="{{ $i->id }}">
                                </div>
                            </div>
                        </div>

                </div>
    </div>
    @endforeach

    @if ($items->isEmpty())
        <div class="bottom-button">
        </div>
    @else
        <div class="bottom-button">
            <button type="submit" class="btn-primary w100" onclick="loading()">Order</button>
        </div>
    @endif
    </form>
    </div>
    @endif
    </div>

@endsection
