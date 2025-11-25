@extends('layouts.main')

@section('title', 'ohayoy-database-transaksi')

@section('content')

    <div class="content">
        <div class="container-w1">
            <div class="flex flex-between align-center gap10 mb10">
                <a href="{{ route('admin.database') }}" class="w-max">
                    <h4 class="link"><i class="ri-arrow-left-long-line link"></i> Kembali</h4>
                </a>

                <form action="{{ route('admin.databaseTransaksiQuery') }}" method="get">
                    <div class="flex flex-between gap10">
                        <input type="text" name="query" id="" placeholder="Cari nomor struk" class="w-100"
                            value="{{ $query }}">
                        <input type="submit" name="" id="" value="Cari" class="btn-primary w-max">
                    </div>
                </form>
            </div>
            <div class="table-container mb40">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>no_struk</th>
                        <th>meja_id</th>
                        <th>nama_pelanggan</th>
                        <th>order_id</th>
                        <th>kasir_id</th>
                        <th>nama_kasir</th>
                        <th>total_bayar</th>
                        <th>status_bayar</th>
                        <th>tanggal</th>
                        <th>waktu</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_struk }}</td>
                            <td>{{ $item->meja_id }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->kasir_id }}</td>
                            <td>{{ $item->nama_kasir }}</td>
                            <td>{{ $item->total_bayar }}</td>
                            <td>{{ $item->status_bayar }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    @include('components.popMenu')

    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close flex flex-end" onclick="closeModal()"><i class="ri-2x ri-close-fill"></i>
            </span>

            <h3>Deskripsi</h3>

            <textarea id="descInput" class="textarea1"></textarea>

            {{-- <div class="flex flex-end">
                    <button class="btn-blue" onclick="saveDesc()">Simpan</button>
                </div> --}}
        </div>
    </div>

@endsection
