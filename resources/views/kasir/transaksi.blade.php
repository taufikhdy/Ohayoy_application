@extends('layouts.main')

@section('title', 'ohayoy-dashboard')

@section('content')

    <div class="content">
        <div class="container-w1">
            <h3 class="element-title">Data Transaksi</h3>

            <div class="widget1">
                <div class="box-s">
                    <h5 class="box-title">Pemasukan Hari ini</h5>
                    <div class="flex align-bottom gap10">
                        <h2 class="text-bold">{{ 'Rp. ' . number_format($pemasukan, 0, ',', '.') }}</h2>
                        {{-- <div class="text-medium">transaksi</div> --}}
                    </div>
                </div>

                <div class="box-s">
                    <h5 class="box-title">Transaksi Hari ini</h5>
                    <div class="flex align-bottom gap10">
                        <h2 class="text-bold">{{ $transaksi }}</h2>
                        <div class="text-medium">transaksi</div>
                    </div>
                </div>

                <div class="box-s">
                    <h5 class="box-title">Pemasukan Bulan ini</h5>
                    <div class="flex align-bottom gap10">
                        <h2 class="text-bold">{{ 'Rp. ' . number_format($pemasukan_bulanan, 0, ',', '.') }}</h2>
                        {{-- <div class="text-medium">transaksi</div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="container-w1">
            <div class="table-container">

                @php
                    $no = 1;
                @endphp

                @if ($data->isEmpty())
                    <div class="text-block text-center">
                        <h5>belum ada data transaksi.</h5>
                    </div>
                @else
                    <table class="p10 table">
                        <div class="toptape">
                            <tr>
                                <th>No</th>
                                <th>Nomor Struk</th>
                                <th>Id Meja</th>
                                <th>Nama Pelanggan</th>
                                <th>Kode Order</th>
                                <th>ID Kasir</th>
                                <th>Kasir</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </div>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $d->no_struk }}</td>
                                <td>{{ $d->meja_id }}</td>
                                <td>{{ $d->nama_pelanggan }}</td>
                                <td>{{ $d->order_id }}</td>
                                <td>{{ $d->kasir_id }}</td>
                                <td>{{ $d->nama_kasir }}</td>
                                <td>{{ 'Rp. ' . number_format($d->total_bayar, 0, ',', '.') }}</td>
                                <td>{{ $d->status_bayar }}</td>
                                <td>{{ $d->created_at->format('d-m-Y') }}</td>
                                <td>{{ $d->waktu }}</td>
                            </tr>
                        @endforeach

                @endif
                </table>
            </div>
            {{ $data->links('vendor.pagination.custom') }}
        </div>
    </div>

@endsection
