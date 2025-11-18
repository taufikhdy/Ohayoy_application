@extends('layouts.main')

@section('title', 'Ohayoy Edit Account')

@section('content')

    <div class="content">
        <div class="container-w1">
            <form action="{{route('admin.editPenggunaPost')}}" method="POST" class="" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$user->id}}">

                <h4 class="mb10">Nama Pengguna</h4>
                <input type="text" name="name" id="" value="{{ $user->name }}" class="mb20">

                <h4 class="mb10">Foto Profil</h4>
                <input type="file" name="foto" id="" class="mb20">

                <div class="flex flex-end gap10">
                    <a href="{{ route('admin.pengguna') }}" class="btn-red text-small">Batal</a>
                    <input type="submit" name="" id="" value="Edit" class="btn-yellow w-max" onclick="loading()">
                </div>
            </form>
        </div>
    </div>
@endsection
