@extends('layouts.main')

@section('title', 'ohayoy-menu')

@section('content')

    <div class="content">

        <div class="container-w1">
            <div class="flex align-center flex-between">
                <div class="element-title">
                    <h3>Tabel Menu</h3>
                </div>
                {{-- <div class="flex align-center gap10">
                    <button>Terlaris</button>
                    <button>Terbaru</button>
                </div> --}}
            </div>

            <div class="table-container">
                <table class="table">


                    @if ($menus->isEmpty())
                        <tr>
                            <p class="text-center">Belum ada data menu</p>
                        </tr>
                    @else
                        <tr>
                            <th>No</th>
                            <th>Gambar Menu</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Penjualan</th>
                            <th>Status Stok</th>
                        </tr>

                        @php
                            $no = 1;
                        @endphp

                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="tape"><img src="{{ asset('storage/' . $menu->foto) }}"
                                        alt="{{ $menu->nama_menu }}"></td>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>{{$menu->penjualan}} Terjual</td>
                                <td>

                                    <form action="{{ route('kasir.menu.status') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <select name="status_stok" class="btn-blue option">
                                            <option value="{{ $menu->status_stok }}">{{ $menu->status_stok }}</option>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="tidak_tersedia">Tidak Tersedia</option>
                                        </select>

                                        <button type="submit" class="btn-blue check-button option-btn" onclick="loading()"><i
                                                class="ri-xl ri-check-fill white"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>

    </div>

@endsection
