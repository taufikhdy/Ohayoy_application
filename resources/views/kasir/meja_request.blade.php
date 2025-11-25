@extends('layouts.main')

@section('title', 'ohayoy-customer-request')

@section('content')

    <div class="content">

        <h3 class="element-title">Customer Request</h3>
        <d class="container-w2">
            @foreach ($mejaAktif as $meja)
                @if ($meja->request === 'request')
                    <div class="box warning-color">
                        @csrf
                        <div class="flex flex-between align-center">
                            <h4 class="element-title">{{ $meja->nama_meja . ' (' . $meja->username . ')' }}</h4>

                            <div class="flex align-center gap10">
                            <form action="{{ route('kasir.rejectMeja') }}" method="post">
                                @csrf
                                    <input type="hidden" name="meja_id" id="" value="{{ $meja->id }}">
                                    <button type="submit" class="btn-blue h-max"
                                        onclick="return confirm('Yakin ingin menolak permintaan reset meja ini?')">Reject</button>
                            </form>
                            <form action="{{ route('kasir.resetMeja') }}" method="post">
                                @csrf
                                <input type="hidden" name="meja_id" id="" value="{{ $meja->id }}">
                                <button type="submit" class="btn-red h-max"
                                    onclick="return confirm('Yakin ingin mengatur ulang meja ini?')">Reset</button>
                            </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="box">
                        <form action="{{ route('kasir.resetMeja') }}" method="post">
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
