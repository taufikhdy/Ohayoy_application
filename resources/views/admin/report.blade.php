@extends('layouts.main')

@section('title', 'ohayoy-report')

@section('content')

    <div class="content">
        <div class="container-w1">
            <h3 class="element-title">Laporan</h3>
            <div class="widget1">
                <div class="long-box">
                    <h5 class="box-title">Pemasukan Harian</h5>
                    {{-- <h2 class="box-number">{{ 'Rp. ' . number_format($pemasukan, 0, ',', '.') }}</h2> --}}
                    <h2 class="box-number"><span id="pemasukan">0</span></h2>
                </div>
                <div class="long-box">
                    <h5 class="box-title">Pemasukan Bulanan</h5>
                    <h2 class="box-number"><span id="pemasukan_bulanan"></span></h2>
                </div>
                <div class="long-box">
                    <h5 class="box-title">Penjualan Tahunan</h5>
                    <h2 class="box-number"><span id="pemasukan_tahunan"></span></h2>
                </div>
            </div>
        </div>

        <div class="container-w2">
            <div class="">
                <h3 class="element-title">Aktifitas</h3>
                <div class="widget2">
                    <div class="box-s">
                        <h5 class="box-title">Meja Aktif</h5>
                        <div class="flex align-bottom gap10">
                            {{-- <div class="text-large text-bold">{{$mejaAktif}}</div> --}}
                            {{-- <div class="text-medium">/ {{$meja}}</div> --}}
                            <div class="text-large text-bold"><span id="mejaAktif">0</span></div>
                            <div class="text-medium">/ <span id="meja">0</span></div>
                        </div>
                    </div>
                    <div class="box-s">
                        <h5 class="box-title">Transaksi Masuk</h5>
                        <div class="flex align-bottom gap10">
                            {{-- <div class="text-large text-bold">{{$transaksi}}</div> --}}
                            <!-- <div class="text-medium">/ 15</div> -->
                            <div class="text-large text-bold"><span id="transaksi">0</span></div>
                        </div>
                    </div>
                    <div class="box-s">
                        <h5 class="box-title">Sisa Waktu Kerja</h5>
                        <div class="flex align-bottom gap10">
                            <div class="text-large text-bold">14j</div>
                            <div class="text-medium">1m</div>
                        </div>
                    </div>
                    <div class="box-s">
                        <h5 class="box-title">Meja Aktif</h5>
                        <div class="flex align-bottom gap10">
                            <div class="text-large text-bold">13</div>
                            <div class="text-medium">/ 15</div>
                        </div>
                    </div>
                    <div class="box-s">
                        <h5 class="box-title">Transaksi Masuk</h5>
                        <div class="flex align-bottom gap10">
                            <div class="text-large text-bold">200</div>
                            <!-- <div class="text-medium">/ 15</div> -->
                        </div>
                    </div>
                    <div class="box-s">
                        <h5 class="box-title">Sisa Waktu Kerja</h5>
                        <div class="flex align-bottom gap10">
                            <div class="text-large text-bold">14j</div>
                            <div class="text-medium">1m</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <h3 class="element-title">Menu Terlaris</h3>
                <ul class="list">
                    @foreach ($terlaris as $t)
                        <li class="list-item">
                            <div class="name">{{$t->nama_menu}}</div>
                            <div class="order">{{$t->penjualan}} Terjual</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="container-w1">
            <h3 class="element-title">Diagram Pemasukan</h3>
            <canvas id="myLineChart"></canvas>
        </div>
    </div>
    </section>


    <script src="{{ asset('js/jquery-3.7.1.min.js') }}?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {
            function loadReport() {
                $.ajax({
                    url: "{{ route('admin.report.data') }}",
                    type: "GET",
                    success: function(data) {
                        // console.log(data);
                        $('#mejaAktif').text(data.mejaAktif);
                        $('#meja').text(data.meja);
                        $('#transaksi').text(data.transaksi);
                        $('#pemasukan').text("Rp. " + Number(data.pemasukan).toLocaleString('id-ID'));
                        $('#pemasukan_bulanan').text("Rp. " + Number(data.pemasukan_bulanan).toLocaleString('id-ID'));
                        // $('#pemasukan_tahunan').text("Rp. " + Number(data.pemasukan).toLocaleString('id-ID'));
                    },
                    error: function(xhr) {
                        alert("Gagal memuat report");
                    }
                });
            }

            loadReport();

            setInterval(loadReport, 8000);

        });
    </script>

    <script src="{{ asset('js/chart.umd.min.js') }}"></script>

    <script>
        const ctx = document.getElementById("myLineChart");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jumat",
                    "Sabtu",
                    "Minggu",
                ],
                datasets: [{
                    label: "Penjualan",
                    data: [12, 19, 15, 8, 10, 14, 20],
                    borderColor: "hsla(218, 95%, 48%, 0.8)",
                    backgroundColor: "hsla(218, 95%, 48%, 0.2)",
                    fill: true,
                    tension: 0.3,
                }, ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "bottom",
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>

@endsection
