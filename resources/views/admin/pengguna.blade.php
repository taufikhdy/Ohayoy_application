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
                        <img src="" alt="user photo" class="foto">

                        <div class="profile-info w-100">
                            <div class="text-info text-bold">{{ Auth::User()->name }}</div>
                            <div class="text-info">Role Pengguna</div>
                            <div class="text-info text-bold">{{ Auth::user()->role->nama_role }}</div>
                            <div class="flex flex-end link w-100 pointer"><i class="ri-xl ri-pencil-line"></i></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box">
                <div class="">
                    <div class="profile-title">
                        <h3>Tambah Pengguna</h3>
                    </div>
                    <form action="{{ route('admin.tambahPengguna') }}" method="post">
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
            <div class="element-title">
                <h3>Data Pengguna</h3>
            </div>

            <div class="table-container">
                <table class="table p10">
                    <tr>
                        <th>No</th>
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
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->role->nama_role }}</td>

                            @if ($u->status === 'offline')
                                <td style="color: crimson; font-weight: 500;">{{ $u->status }}</td>
                            @elseif ($u->status === 'online')
                                <td style="color: var(--primary); font-weight: 500;">{{ $u->status }}</td>
                            @endif
                            {{-- <td>{{$}}</td> --}}
                            <td class="flex flex-center align-center gap10">
                                <form action="{{ route('admin.regeneratePass', $u->id) }}" method="post"
                                    onclick="return confirm('Yakin ingin mengatur ulang password pengguna ini?')">
                                    @csrf
                                    <button type="submit" class="btn-blue">reset password</button>
                                </form>
                                <form action="{{ route('admin.hapusPengguna', $u->id) }}" method="post"
                                    onclick="return confirm('Yakin ingin menghapus akun pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-red" onclick="loading()">hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>


        </div>

    @endsection
