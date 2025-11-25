@extends('layouts.main')

@section('title', 'ohayoy-database')

@section('content')
    <div class="content">
        <div class="container-w1">
            <h3 class="element-title">Data</h3>

            <a href="{{ route('admin.databaseTransaksi') }}">
                <h4 class="link">Tabel Transaksi <i class="ri-external-link-fill link"></i></h4>
            </a>
            <div class="non-overflow mb40">
                <table class="w-100 text-wrap box-after-gradation">
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
                        <th>waktu</th>
                        <th>tanggal</th>
                    </tr>

                    @php
                        $no = 1;
                    @endphp

                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_struk }}</td>
                            <td>{{ $item->meja_id }}</td>
                            <td>{{ $item->nama_pelanggam }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->kasir_id }}</td>
                            <td>{{ $item->nama_kasir }}</td>
                            <td>{{ $item->total_bayar }}</td>
                            <td>{{ $item->status_bayar }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <a href="{{ route('admin.databaseMenu') }}">
                <h4 class="link">Tabel Menu <i class="ri-external-link-fill link"></i></h4>
            </a>
            <div class="non-overflow mb40">
                <table class="w-100 box-after-gradation">
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
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_menu }}</td>
                            <td>
                                <textarea name="deskripsi" id="" cols="" rows="" class="" onclick="openModal(this)">{{ $item->deskripsi }}</textarea>
                            </td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->status_stok }}</td>
                            <td>{{ $item->penjualan }}</td>
                            <td>{{ $item->foto }}</td>
                            <td>{{ $item->kategori_id }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>


            <a href="{{ route('admin.databasePengguna') }}">
                <h4 class="link">Tabel Pengguna <i class="ri-external-link-fill link"></i></h4>
            </a>
            <div class="non-overflow mb40">
                <table class="w-100 box-after-gradation">
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>status</th>
                        <th>foto</th>
                        <th>password</th>
                        <th>role_id</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pengguna as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->foto }}</td>
                            <td>{{ $item->password }}</td>
                            <td>{{ $item->role_id }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}

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
