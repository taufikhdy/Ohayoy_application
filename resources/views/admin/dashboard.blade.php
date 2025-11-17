@extends('layouts.main')

@section('title', 'ohayoy-dashboard')

@section('content')

    <div class="content">
        <div class="container-w1">
          <h3 class="element-title">Beranda</h3>
          <div class="widget1">
            <div class="long-box">
              <h5 class="box-title">Penjualan Harian</h5>
              <h2 class="box-number">Rp.500.000,00</h2>
            </div>
            <div class="long-box">
              <h5 class="box-title">Penjualan Bulanan</h5>
              <h2 class="box-number">Rp.15.000,000</h2>
            </div>
            <div class="long-box">
              <h5 class="box-title">Penjualan Tahunan</h5>
              <h2 class="box-number">Rp.150.000,000</h2>
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
            <h3 class="element-title">Diagram Pemasukan</h3>
            <canvas id="myLineChart"></canvas>
          </div>
        </div>
      </div>
    </section>

    <script src="{{asset('js/chart.umd.min.js')}}"></script>

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
          datasets: [
            {
              label: "Penjualan",
              data: [12, 19, 15, 8, 10, 14, 20],
              borderColor: "hsla(218, 95%, 48%, 0.8)",
              backgroundColor: "hsla(218, 95%, 48%, 0.2)",
              fill: true,
              tension: 0.3,
            },
          ],
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
