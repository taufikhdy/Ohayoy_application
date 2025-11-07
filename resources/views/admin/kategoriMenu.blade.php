@extends('layouts.main')

@section('title', 'ohayoy-kategori-menu')

@section('content')

    {{-- <div class="">
    <form action="">
        <h3 class="element-title">Tambah Kategori</h3>
        <input type="text" name="" id="" placeholder="Nama Kategori">
        <input type="submit" value="">
    </form>
</div> --}}
    <div class="content">
        <div class="container-w1">

            <div class="element-title">
                <h3>Kategori</h3>
            </div>

            <div class="box w-100">
                <form action="{{ route('admin.tambahKategori') }}" method="post">
                    @csrf
                    <div class="flex align-center gap15">
                        <input type="text" name="nama_kategori" id="" placeholder="Nama Kategori" required>
                        <input type="submit" name="" id="" class="btn-primary" value="Tambah"
                            onclick="loading()">
                    </div>
                </form>
            </div>

            <div class="list">
                @if ($kategoris->isEmpty())
                    <p class="text-center element-title">Tidak ada kategori</p>
                @else
                    @foreach ($kategoris as $kategori)
                        <form action="{{ route('admin.editKategori') }}" method="post">
                            <li class="list-item gap10">
                                @csrf
                                <input type="hidden" name="kategori_id" id="" value="{{ $kategori->id }}">
                                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" disabled
                                    class="edit-input w-100">
                                <button type="submit" class="hidden" id="submitEdit{{ $kategori->id }}"></button>

                                <div class="flex gap10">
                                    <label for="submitEdit{{ $kategori->id }}" class="btn-blue editConfirm"
                                        style="display: none;" onclick="loading()"><i
                                            class="ri-xl ri-check-fill white"></i></label>
                                    <button type="button" class="btn-yellow editKategori">Edit</button>
                        </form>

                        <form action="{{ route('admin.hapusKategori', $kategori->id) }}" method="post"
                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="" id="" class="btn-red" value="Hapus"
                                onclick="loading()">
            </div>
            </form>
            </li>
            @endforeach
            @endif
        </div>

    </div>
    </div>

@endsection
