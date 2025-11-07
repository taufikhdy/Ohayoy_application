@extends('layouts.customer')

@section('title', 'ohayoy-ulasan-menu')

@section('content')

    @if (session('success'))
        <div class="message success" id="message">
            {{ session('success') }}
        </div>
    @endif

    <div class="back-link text-medium">
        <h4><a href="{{ route('customer.detailMenu', $menu->id) }}"><i class="ri-lg ri-arrow-left-long-line"></i> ulasan
                menu</a></h4>
    </div>
    <div class="detail-menu">

        <div class="flex gap30 menu-square">
            <img src="{{ asset('storage/' . $menu->foto) }}" alt="" class="detail-gambar">

            <div class="flex flex-around fd-column menu-info">
                <h2>{{ $menu->nama_menu }}</h2>
                <p class="badge-sm mt10">{{ $menu->kategori->nama_kategori }}</p>
                <br>
                <div class="flex gap30 align-center w100">
                    <div class="">
                        <p class="text-medium">Harga</p>
                        <h2>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</h2>
                    </div>

                    @if ($menu->status_stok === 'tidak_tersedia')
                        <p class="btn-red-soft">{{ $menu->status_stok }}</p>
                    @elseif ($menu->status_stok === 'tersedia')
                        <p class="btn-green-soft">{{ $menu->status_stok }}</p>
                    @endif
                </div>
            </div>

        </div>
    </div>


    <div class="container-w1 mb40">
        <h2 class="element-title">Rating <i class="ri-star-fill text-medium star"></i>
            {{ number_format($menu->rating_avg_nilai, 1) }}</h2>
        <div class="box full">
            <form action="{{ route('customer.tambahUlasan') }}" method="post">
                @csrf

                <h4 class="mb15">Yuk beri ulasan kamu untuk menu yang satu ini</h4>

                <input type="hidden" name="menu_id" id="" value="{{ $menu->id }}">
                <input type="hidden" name="meja_id" id="" value="{{ Auth::guard('meja')->user()->id }}">

                <input type="number" name="nilai" id="" placeholder="Nilai 1-5" min="1" max="5">

                <textarea name="ulasan" id="" cols="" rows="" class="textarea1"
                    placeholder="Ketik ulasan kamu disini"></textarea>

                <div class="flex flex-end">
                    {{-- <input type="submit" name="" id="" class="btn-primary wmax"> --}}
                    <button type="submit" class="btn-primary wmax" onclick="loading()">kirim ulasan</button>
                </div>
            </form>
        </div>

        <h3 class="elemen-title">Ulasan Pelanggan ( {{ $menu->rating_count }} )</h3>

        <div class="flex fd-column gap15">
            @foreach ($ulasan as $u)
                <div class="box full">
                    <div class="flex flex-between">
                        <h4 class="mb20">{{ $u->username }} ({{ $u->meja->nama_meja }}) <i
                                class="ri-star-fill text-medium star"></i> {{ $u->nilai }}</h4>
                        <p class="text-small">{{ $u->created_at->format('d-m-Y') }}</p>
                    </div>
                    <p>{{ $u->ulasan }}</p>
                </div>
            @endforeach
        </div>

    </div>

@endsection
