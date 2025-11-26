@extends('layouts.main')

@section('title', 'ohayoy-database-menu')

@section('content')

    <div class="content">
        <div class="container-w1">
            <div class="flex flex-between align-center gap10 mb10">
                <a href="{{ route('admin.database') }}" class="w-max text-nowrap">
                    <h4 class="link"><i class="ri-arrow-left-long-line link"></i> Kembali</h4>
                </a>

                <form action="{{ route('admin.databaseMenuQuery') }}" method="get">
                    @csrf
                    <div class="flex flex-between gap10">
                        <input type="text" name="query" id="" placeholder="Cari menu" class="w-100"
                            value="{{ $query }}">
                        <input type="submit" name="" id="" value="Cari" class="btn-primary w-max">
                    </div>
                </form>
            </div>
            <div class="table-container mb40">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>nama_menu</th>
                        <th>deskripsi</th>
                        <th>harga</th>
                        <th>status_stok</th>
                        <th>penjualan</th>
                        <th>foto</th>
                        <th>kategori_id</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($menu as $item)
                        <tr class="text-left">
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_menu }}</td>
                            <td>
                                <textarea name="deskripsi" id="" cols="" rows="" class="" onclick="openModal(this)">{{ $item->deskripsi }}</textarea>
                            </td>
                            <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->status_stok }}</td>
                            <td>{{ $item->penjualan }}</td>
                            <td>{{ $item->foto }}</td>
                            <td>{{ $item->kategori_id . ' (' . $item->kategori->nama_kategori . ')' }}</td>
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
