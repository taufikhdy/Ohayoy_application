@extends('layouts.customer')

@section('title', 'ohayoy-dashboard')

@section('content')

    @if(session('error'))

        <div class="message error" id="message">
            {{session('error')}}
        </div>

    @endif

    <div class="banner">
        <img src="{{ asset('images/banner.jpeg') }}" alt="" class="object-fit">
        <div class="searchbox1">
            <div class="title">
                <h3>Yuk cari menu pilihan mu!</h3>
            </div>
            <form action="{{ route('customer.cariMenu') }}" method="get">
                <div class="flex align-center gap10">
                    <input type="text" name="search" id="" value="{{ request('search') }}"
                        placeholder="Ketik nama menu">
                    <button type="submit" class="btn-primary"><i class="ri-search-line text-white"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-block text-center">
        <h1 class="title-box">Lagi pengen yang enak-enak?</h1>
        <p class="font-sb">Ini dia menu andalan yang paling sering bikin pelanggan balik lagi. <br>
            Siap temenin kamu kapan aja!</p>
    </div>

    <div class="container-w4 gap20">

        @foreach ($menu as $m)
            <a href="{{ route('customer.detailMenu', $m->id) }}" class="menu-box gap15">
                <div class="gambar">
                    {{-- <span class="badge-sm">{{$m->kategori->nama_kategori}}</span> --}}
                    <img src="{{ asset('storage/' . $m->foto) }}" alt="{{'imgFor' . $m->nama_menu }}" class="object-fit">
                </div>

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

    <div class="title-box w100 text-center">
        <a href="{{ route('customer.menu') }}" class="btn-primary-soft">Lihat lebih banyak</a>
    </div>

    <div class="text-block text-center">
        <h1 class="title-box">Bingung mau pesen apa?</h1>
        <p class="font-sb">Tenang, kita bantu pilih sesuai selera kamu.</p>
    </div>

    <div class="container-w6 gap15">
        @foreach ($kategoris as $kategori)
            <a href="{{route('customer.cariKategori', $kategori->id)}}" class="box">
                <h4>{{$kategori->nama_kategori}}</h4>
            </a>
        @endforeach
    </div>

    {{-- <div class="footer {{ Request::is('/customer/dashboard') ? 'on' : '' }}"> --}}
    @include('components.footer')
    {{-- </div> --}}
@endsection
