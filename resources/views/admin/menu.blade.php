@extends('layouts.main')

@section('title', 'ohayoy-menu')

@section('content')

    <div class="content">

        <div class="container-w2">
            <div class="">
                <div class="element-title">
                    <h3>Menu terlaris</h3>
                </div>

                @foreach ($terlaris as $t)
                    <li class="list-item">
                        <div class="name">{{ $t->nama_menu }}</div>
                        <div class="order">{{ $t->penjualan }} Terjual</div>
                    </li>
                @endforeach
                </ul>
            </div>

            <div id="cateForm" class="menuCate">
                <div class="element-title flex">
                    <h3>Tambah Kategori</h3>
                    <button id="cateSwitch" class="btn-blue">Tambah Menu</button>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahKategori') }}" method="post">
                        @csrf
                        <div class="flex align-center gap15">
                            <input type="text" name="nama_kategori" id="" placeholder="Nama Kategori" required>
                            <input type="submit" name="" id="" class="btn-primary" value="Tambah"
                                onclick="loading()">
                        </div>
                    </form>
                </div>
            </div>


            <div id="menuForm" class="menuForm on">
                <div class="element-title flex">
                    <h3>Tambah Menu</h3>
                    <button id="menuSwitch" class="btn-blue">Tambah Kategori</button>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahMenu') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="flex align-center gap15 mb10">
                            <input type="text" name="nama_menu" id="" placeholder="Nama Menu" required>
                            <input type="number" name="harga" id="" placeholder="Harga Menu" required>
                        </div>

                        <div class="flex align-center gap15 flex-wrap mb10">
                            <select name="status_stok" id="" class="btn-blue" required>
                                <option value="">Status Stok</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="tidak_tersedia">Tidak Tersedia</option>
                            </select>
                            <select name="kategori_id" id="" class="btn-blue" required>
                                <option value="">-- Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>

                            <label for="foto" class="btn-blue text-small"><i
                                    class="ri-image-add-line text-medium text-white"></i> Pilih gambar</label>
                            <input type="file" name="gambar_menu" id="foto" class="file">
                        </div>

                        <textarea name="deskripsi" id="" cols="" rows="" class="textarea1"
                            placeholder="Deskripsi menu, contoh:Kopi susu dengan krim yang lembut"></textarea>

                        <input type="submit" class="btn-primary" value="Tambah" onclick="loading()">
                    </form>
                </div>
            </div>
        </div>

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
                        <tr class="toptape">
                            <th>No</th>
                            <th>Gambar Menu</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Status Stok</th>
                            <th>Penjualan</th>
                            <th>Ulasan</th>
                            <th>Aksi</th>
                        </tr>

                        @php
                            $no = 1;
                        @endphp

                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <form action="{{ route('admin.editMenu') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <td class="tapes">
                                        <label for="edit-foto{{ $menu->id }}"><img
                                                src="{{ asset('storage/' . $menu->foto) }}"
                                                alt="{{ $menu->nama_menu }}"></label>
                                        <input type="file" name="foto" id="edit-foto{{ $menu->id }}"
                                            class="edit-input file" disabled>
                                    </td>
                                    <td><input type="text" name="nama_menu" class="edit-input w-max"
                                            value="{{ $menu->nama_menu }}" disabled></td>
                                    <td>
                                        <div class="flex align-center gap10">Rp. <input type="text" name="harga"
                                                value="{{ $menu->harga }}" class="edit-input w-max" disabled></div>
                                        <input type="hidden" name="menu_id" id=""
                                            value="{{ $menu->id }}">
                                        <button type="submit" class="hidden"
                                            id="submitEdit{{ $menu->id }}">Edit</button>
                                    </td>

                                    <td>
                                        <textarea name="deskripsi" id="" cols="" rows=""
                                            class="edit-input w-max textarea-edit desc-text" disabled onclick="openModal(this)">{{ $menu->deskripsi }}</textarea>
                                    </td>

                                    <td>
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <select name="kategori_id" class="btn-blue option edit-input" disabled>
                                            <option value="{{ $menu->kategori_id }}">{{ $menu->kategori->nama_kategori }}
                                            </option>

                                            @foreach ($kategoris as $k)
                                                <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                </form>


                                <td>

                                    <form action="{{ route('admin.menu.status') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <select name="status_stok" class="btn-blue option">
                                            <option value="{{ $menu->status_stok }}">{{ $menu->status_stok }}
                                            </option>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="tidak_tersedia">Tidak Tersedia</option>
                                        </select>

                                        <button type="submit" class="btn-blue check-button option-btn"
                                            onclick="loading()"><i class="ri-xl ri-check-fill white"></i></button>
                                    </form>

                                </td>

                                <td>{{ $menu->penjualan }} Terjual</td>
                                <td><a href="{{ route('admin.ulasan', $menu->id) }}" class="link">lihat ulasan</a></td>
                                <td>
                                    <div class="flex align-center flex-center gap10">
                                        <button class="btn-yellow editForm">Edit</button>
                                        <label for="submitEdit{{ $menu->id }}" class="btn-blue editConfirm"
                                            style="display: none;" onclick="loading()"><i
                                                class="ri-xl ri-check-fill white"></i></label>
                                        <form action="{{ route('admin.hapusMenu', $menu->id) }}" method="post"
                                            onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-red" onclick="loading()">hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>

            {{ $menus->links('vendor.pagination.custom') }}

        </div>


        {{-- Modal --}}

        <div class="modal" id="modal">
            <div class="modal-content">
                <span class="close flex flex-end" onclick="closeModal()"><i class="ri-2x ri-close-fill"></i>
                </span>

                <h3>Edit Deskripsi</h3>

                <textarea id="descInput" class="textarea1"></textarea>

                <div class="flex flex-end">
                    <button class="btn-blue" onclick="saveDesc()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

@endsection
