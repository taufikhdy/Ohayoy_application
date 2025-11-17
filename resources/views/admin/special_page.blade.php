@extends('admin.toko')

@section('title', 'Ohayoy -uncommon page')

@section('content')

    <div class="content">
        <div class="container-w1">
            <form action="{{route('admin.editTokoPost')}}" method="POST" class="">
                @csrf

                <input type="hidden" name="id_toko" value="{{$toko->id}}">

                <h4 class="mb10">Nama Toko</h4>
                <input type="text" name="nama_toko" id="" value="{{ $toko->nama_toko }}" class="mb20">
                <h4 class="mb10">Tagline Toko</h4>
                <input type="text" name="tagline_toko" id="" value="{{ $toko->tagline_toko }}" class="mb20">
                <h4 class="mb10">Alamat Toko</h4>
                <textarea name="alamat_toko" id="" class="mb20 textarea1">{{ $toko->alamat_toko }}</textarea>
                <h4 class="mb10">Website Toko</h4>
                <input type="text" name="website_toko" id="" value="{{ $toko->website_toko }}" class="mb20">
                <h4 class="mb10">Ucapan Terimakasih</h4>
                <input type="text" name="ucapan" id="" value="{{ $toko->ucapan }}" class="mb20">

                <div class="flex flex-end gap10">
                    <a href="{{ route('admin.toko') }}" class="btn-red text-small">Batal</a>
                    <input type="submit" name="" id="" value="Edit" class="btn-blue w-max" onclick="loading()">
                </div>
            </form>
        </div>
    </div>
@endsection
