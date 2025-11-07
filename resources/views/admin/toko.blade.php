@extends('layouts.main')

@section('title', 'ohayoy-toko')

@section('content')

    {{-- <div class="">
    <form action="">
        <h3 class="element-title">Tambah toko</h3>
        <input type="text" name="" id="" placeholder="Nama Kategori">
        <input type="submit" value="">
    </form>
</div> --}}
    <div class="content">
        <div class="container-w1">

            <div class="element-title">
                <h3>Tentang Toko</h3>
            </div>


            <h1 class="element-title text-center">{{ $toko->nama_toko }}</h1>
            <h3 class="text-center">{{ $toko->tagline_toko }}</h3>

            <div class="element-title text-center">
                <p>{{ $toko->alamat_toko }}</p>
                <a href="" class="link">{{ $toko->website_toko }}</a>
            </div>

            <p class="element-title text-center">
                {{$toko->ucapan}}
            </p>

            <div class="w-100 text-center">
                <button type="button" class="btn-yellow">Edit</button>
                <br>
                <br>
                <p class="text-small">Diperbarui Pada {{$toko->updated_at}} <br> Dibuat Pada {{$toko->created_at}}</p>
            </div>
        </div>

    </div>
    </div>

@endsection
