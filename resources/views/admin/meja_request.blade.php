@extends('layouts.main')

@section('title', 'ohayoy-customer-request')

@section('content')

    <div class="content">

        <h3 class="element-title">Customer Request</h3>
        <d class="container-w2">
            @foreach ($mejaAktif as $meja)
                @if ($meja->request === 'request')
                    <div class="box" style="background-color: hsla(348, 83%, 47%, 0.7)">
                        <form action="{{ route('admin.resetMeja') }}" method="post">
                            @csrf
                            <div class="flex flex-between align-center">
                                <h4 class="element-title">{{ $meja->nama_meja . ' (' . $meja->username . ')' }}</h4>
                                <input type="hidden" name="meja_id" id="" value="{{ $meja->id }}">
                                <button type="submit" class="btn-red h-max"
                                    onclick="return confirm('Yakin ingin mengatur ulang meja ini?')">Reset</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="box">
                        <form action="{{ route('admin.resetMeja') }}" method="post">
                            @csrf
                            <div class="flex flex-between align-center">
                                <h4 class="element-title">{{ $meja->nama_meja . ' (' . $meja->username . ')' }}</h4>
                                <input type="hidden" name="meja_id" id="" value="{{ $meja->id }}">
                                <button type="submit" class="btn-red h-max"
                                    onclick="return confirm('Yakin ingin mengatur ulang meja ini?')">Reset</button>
                            </div>
                        </form>
                    </div>
                @endif
            @endforeach
    </div>

    </div>

@endsection
