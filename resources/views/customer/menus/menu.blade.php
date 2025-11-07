@extends('layouts.customer')

@section('title', 'ohayoy-menu')

@section('content')

    <div class="banner1">
        <img src="{{ asset('images/banner.jpeg') }}" alt="" class="object-fit">
    </div>


    <div class="menu-section">
        <div class="searchbox2">
            <form action="{{ route('customer.cariMenu') }}" method="get">
                <div class="flex align-center gap10">
                    <input type="text" name="search" id="" value="{{ request('search') }}"
                        placeholder="Cari menu">
                    <button type="submit" class="btn-primary"><i class="ri-search-line text-white"></i> Cari</button>
                </div>
            </form>
        </div>

        <div class="title-box-l">
            <h2>Menu Berdasarkan Kategori</h2>
        </div>

        <div class="container-w1">
            <div class="flex gap10">
                @foreach ($kategori as $k)
                    <a href="{{ route('customer.cariKategori', $k->id) }}" class="badge-sm">{{ $k->nama_kategori }}</a>
                @endforeach
            </div>
        </div>

        <div class="title-box-l">
            <h2>Menu</h2>
        </div>

        <div class="container-w4 gap20">

            @foreach ($menu as $m)
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

    </div>

@endsection
