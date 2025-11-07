@extends('layouts.customer')

@section('title', 'ohayoy-mencari')

@section('content')


    <div class="menu-section">

        <div class="searchbox2">
            <form action="{{ route('customer.cariMenu') }}" method="get">
                <div class="flex align-center gap10">
                    <input type="text" name="search" id="" value="{{ request('search') }}" placeholder="Cari menu">
                    <button type="submit" class="btn-primary"><i class="ri-search-line text-white"></i> Cari</button>
                </div>
            </form>
        </div>

        <div class="title-box-l">
            @if ($search)
                <h4>Mencari hasil ( {{ $search }} )</h4>
            @elseif (!$search && $search_kategori)
                <h4>Kategori Menu ( {{ $search_kategori->nama_kategori }} )</h4>
            @endif
        </div>

        @if ($menus->isEmpty())
            <div class="text-block text-center">
                <h5>Menu tidak tersedia.</h5>
            </div>
        @else
            <div class="container-w4 gap20">

                @foreach ($menus as $m)
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

        @endif

    </div>

@endsection
