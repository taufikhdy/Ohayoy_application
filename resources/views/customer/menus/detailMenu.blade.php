@extends('layouts.customer')

@section('title', 'ohayoy-detail-menu')

@section('content')

    @if (session('success'))
        <div class="message success" id="message">{{ session('success') }}</div>
    @endif

    {{-- @if (request('msg') === 'success')
        <div class="message-success">
            Menu berhasil ditambahkan ke keranjang, yuk pesan sekarang 🍟🥤
        </div>
    @endif --}}

    <div class="back-link text-medium">
        <h4><a href="{{ route('customer.menu') }}"><i class="ri-lg ri-arrow-left-long-line"></i> detail menu</a></h4>
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

        <div class="detail-badge">
            <div class="badge text-center">
                {{-- <pre>{{ print_r(session()->all(), true) }}</pre> --}}

                <h3><i class="ri-star-fill text-medium star"></i> {{ number_format($menu->rating_avg_nilai, 1) }}</h3>
                <a href="{{ route('customer.ulasan', $menu->id) }}" class="badge-link">Lihat Ulasan</a>
            </div>

        </div>

        @if ($menu->status_stok === 'tidak_tersedia')
        @elseif ($menu->status_stok === 'tersedia')
            <div class="menu-choice">
                <form action="{{ route('customer.tambahMenu') }}" method="POST">
                    @csrf

                    <div class="flex align-center gap10 w100">
                        <input type="hidden" name="meja_id" id="" value="{{ Auth::guard('meja')->id() }}">
                        <input type="hidden" name="menu_id" id="" value="{{ $menu->id }}">
                        <input type="number" name="jumlah" id="jumlah" placeholder="Jumlah Pesan" value=""
                            required>

                        <button type="submit" class="btn-primary w100" onclick="loading()">
                            Tambah
                        </button>
                    </div>
                </form>

                {{-- <button class="btn-primary-soft text-medium">
                Masukan ke keranjang
            </button> --}}
            </div>
        @endif


        <h3 class="title-box">Deskripsi Menu</h3>
        <div class="deskripsi-menu">
            <p>{!! nl2br(e($menu->deskripsi)) !!}</p>
        </div>
    </div>

    <div class="title-box-l text-center">
        <h3>Kamu mungkin juga suka!</h3>
    </div>

    <div class="container-w4 gap20">

        @foreach ($rekomendasi as $m)
            <a href="{{ route('customer.detailMenu', $m->id) }}" class="menu-box gap15">
                <div class="gambar">
                    <img src="{{ asset('storage/' . $m->foto) }}" alt="" class="object-fit">
                </div>

                {{-- <div class="flex flex-between align-center w100">
                    <div class="">
                        <h3 class="title">{{ $m->nama_menu }}</h3>
                        <p class="badge-sm">{{ $m->kategori->nama_kategori }}</p>
                    </div>

                    <h3 class="text-nowrap"><i class="ri-star-fill text-medium star"></i>
                        {{ number_format($m->rating_avg_nilai, 1) }}</h3>
                </div> --}}

                <div class="w100">
                    <h3 class="title mb30">{{ $m->nama_menu }}</h3>
                    <div class="menu-badge w100">
                        {{-- <div class=""> --}}
                        <p class="badge-sm">{{ $m->kategori->nama_kategori }}</p>
                        <h3 class="text-nowrap"><i class="ri-star-fill text-medium star"></i>
                            {{ number_format($m->rating_avg_nilai, 1) }}</h3>
                        {{-- </div> --}}

                    </div>
                </div>
            </a>
        @endforeach

    </div>

    <div class="title-box w100 text-center mb40">
        <a href="{{ route('customer.menu') }}" class="btn-primary-soft">Lihat lebih banyak</a>
    </div>

@endsection
