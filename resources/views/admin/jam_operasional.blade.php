@extends('layouts.main')

@section('title', 'ohayoy-jam-operasional')

@section('content')

    <div class="content">
        <div class="container-w2">

            <div class="">

                <h3>Sisa Waktu Kerja</h3>
                <h2 class="mt10 w-max" id="countdown"></h2>

                <h3 class="element-title">Jam Operasional</h3>


                <div class="table-container">
                    <table class="">
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        @php
                            $no = 1;
                        @endphp

                        @foreach ($jams as $jam)
                            @if ($jam->status === 0)
                                <tr style="background-color: orangered">
                                @else
                                <tr>
                            @endif

                            <td>{{ $no++ }}</td>
                            <td class="text-left">{{ $jam->hari }}</td>
                            <form action="{{ route('admin.editJam') }}" method="post">
                                @csrf
                                <input type="hidden" name="jam_id" value="{{ $jam->id }}">
                                <td><input type="time" name="jam_buka" id="" class="edit-input"
                                        value="{{ $jam->jam_buka }}" disabled></td>
                                <td><input type="time" name="jam_tutup" id="" class="edit-input"
                                        value="{{ $jam->jam_tutup }}" disabled></td>
                                <td>
                                    <select name="status" id="" class="btn-blue edit-input" disabled>
                                        @if ($jam->status === 1)
                                            <option value="1">Buka</option>
                                        @elseif ($jam->status === 0)
                                            <option value="0">Tutup</option>
                                        @endif
                                        <option value="1">Buka</option>
                                        <option value="0">Tutup</option>
                                    </select>
                                </td>
                                <button type="submit" name="" id="submitEdit{{ $jam->id }}" class="hidden">
                            </form>
                            <td>
                                <button class="btn-yellow editForm">Edit</button>
                                <label for="submitEdit{{ $jam->id }}" class="btn-blue editConfirm"
                                    style="display: none;" onclick="loading()"><i
                                        class="ri-xl ri-check-fill white"></i></label>
                            </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

    </div>
    </div>

    <script>
        const jamTutup = "{{ $now->jam_tutup }}";

        setInterval(() => {
            const now = new Date();
            const [h, m] = jamTutup.split(':');
            const end = new Date();
            end.setHours(h, m, 0, 0);

            let diff = end - now;

            // kalau sudah tutup
            if (diff <= 0) {
                document.getElementById("countdown").innerText = "Sudah tutup";
                return;
            }

            const jam = Math.floor(diff / (1000 * 60 * 60));
            const menit = Math.floor(diff / (1000 * 60)) % 60;
            const detik = Math.floor(diff / 1000) % 60;

            document.getElementById("countdown").innerHTML =
                `<i class="ri-time-line"></i> ${jam} jam ${menit} menit ${detik} detik`;
        }, 1000);
    </script>

@endsection
