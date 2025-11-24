@extends('layouts.main')

@section('title', 'ohayo-pengguna')

@section('content')

    @if (session('success'))
        <div class="message success" id="message">
            {{ session('success') }}
        </div>
    @endif

    <div class="content">

        <div class="container-w2">
            <div class="">
                <div class="profile-card">
                    <div class="profile-title">
                        <h3>Profil</h3>
                    </div>

                    <div class="profile-content">
                        <img src="{{ Storage::url($admin->foto) }}" alt="user photo" class="foto">

                        <div class="profile-info w-100">
                            <div class="text-info text-bold">{{ Auth::User()->name }}</div>
                            <div class="text-info">Role Pengguna</div>
                            <div class="text-info text-bold">{{ Auth::user()->role->nama_role }}</div>
                            <div class="flex flex-end link w-100"><a href="{{ route('admin.editAkun', Auth::user()?->id) }}"
                                    class="btn-blue">Edit</a></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box">
                <div class="">
                    <div class="profile-title">
                        <h3>Tambah Pengguna</h3>
                    </div>
                    <form action="{{ route('admin.tambahPengguna') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" id="" placeholder="Nama Pengguna">

                        <div class="flex align-center gap15" style="margin: 10px 0px;">
                            <input type="text" name="password" id="" placeholder="Password" value="password123">
                            <select name="role_id" id="" class="btn-blue">
                                <option value="">-- Role --</option>
                                @foreach ($role as $role)
                                    <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                @endforeach
                            </select>

                            <label for="foto" class="btn-blue text-small"><i
                                    class="ri-image-add-line text-medium text-white"></i> Foto</label>
                            <input type="file" name="foto" id="foto" class="file">
                        </div>

                        <input type="submit" class="btn-primary" value="Tambah" onclick="loading()">
                    </form>
                </div>
            </div>
        </div>

        <div class="container-w1">
            <div class="element-title flex flex-between gap10">
                <h3 class="w-max">Data Pengguna</h3>

                <form action="{{ route('admin.cariPengguna') }}" method="get">
                    <div class="flex flex-between gap10">
                        <input type="text" name="query" id="" placeholder="Cari pengguna" class="w-100"
                            value="{{ $query }}">
                        <input type="submit" name="" id="" value="Cari" class="btn-primary w-max">
                    </div>
                </form>
            </div>

            <div class="table-container">
                <table class="table p10">
                    @if ($user->isEmpty())
                        <tr>
                            <p class="text-center">Belum ada data pengguna</p>
                        </tr>
                    @else
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Pengguna</th>
                            <th>Role</th>
                            <th>Status</th>
                            {{-- <th>Key</th> --}}
                            <th>Aksi</th>
                        </tr>


                        @php
                            $no = 1;
                        @endphp

                        @foreach ($user as $u)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><img src="{{ Storage::url($u->foto) }}" alt="photo" width="" height=""
                                        class="full-round"></td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->role->nama_role }}</td>

                                @if ($u->status === 'offline')
                                    <td style="color: crimson; font-weight: 500;">{{ $u->status }}</td>
                                @elseif ($u->status === 'online')
                                    <td style="color: var(--primary); font-weight: 500;">{{ $u->status }}</td>
                                @endif
                                {{-- <td>{{$}}</td> --}}
                                <td>
                                    <div class="flex flex-center align-center gap10">
                                        <form action="{{ route('admin.regeneratePass', $u->id) }}" method="post"
                                            onclick="return confirm('Yakin ingin mengatur ulang password pengguna ini?')">
                                            @csrf
                                            <button type="submit" class="btn-blue">reset password</button>
                                        </form>
                                        <a href="{{ route('admin.editAkun', $u->id) }}"
                                            class="btn-yellow text-small">edit</a>
                                        <form action="{{ route('admin.hapusPengguna', $u->id) }}" method="post"
                                            onclick="return confirm('Yakin ingin menghapus akun pengguna ini?')">
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


        </div>

    @endsection
