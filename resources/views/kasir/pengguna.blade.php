@extends('layouts.main')

@section('title', 'ohayoy-dashboard')

@section('content')

    <div class="content">
        <div class="container-w2">
            <div class="profile-card">
                <div class="profile-title">
                    <h3>Profil</h3>
                </div>

                <div class="profile-content">
                    <img src="{{ Storage::url($kasir->foto) }}" alt="user photo" class="foto">

                    <div class="profile-info w-100">
                        <div class="text-info text-bold">{{ Auth::User()->name }}</div>
                        <div class="text-info">Role Pengguna :</div>
                        <div class="text-info text-bold">{{ Auth::user()->role->nama_role }}</div>
                        {{-- <div class="flex flex-end link w-100"><a href="{{route('kasir.editAkun', Auth::user()?->id)}}" class="btn-blue">Edit</a></div> --}}
                    </div>
                </div>
            </div>

        </div>

        <div class="container-w1">
            <h3 class="element-title">Data Transaksi</h3>

            <div class="widget1">
                <div class="long-box">
                    <h5 class="box-title">Transaksi Hari ini oleh {{ Auth::user()?->name }}</h5>
                    <div class="flex align-bottom gap10">
                        <h2 class="text-bold">{{ $transaksi }}</h2>
                        <div class="text-medium">transaksi</div>
                    </div>
                </div>
                <div class="long-box">
                    <h5 class="box-title">Total Transaksi ditangani oleh {{ Auth::user()?->name }}</h5>
                    <div class="flex align-bottom gap10">
                        <h2 class="text-bold">{{ $allTransaksi }}</h2>
                        <div class="text-medium">transaksi</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
