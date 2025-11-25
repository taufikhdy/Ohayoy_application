<footer>
    <div class="container-w4 w100 gap30">
        <div class="">
            <a href="http://cafe_web.test/customer/dashboard" class="">
                <h1>Ohayoy</h1>
            </a>
            <p class="title-box"><a href="https://maps.app.goo.gl/BitGVs8rUvDwLE6E7">{{ $toko->alamat_toko }} <i class="ri-external-link-fill"></i></a></p>
            @foreach ($jam as $j)
                <p class="text-small mb10">{{ $j->hari . ' : ' . $j->jam_buka . ' -   ' . $j->jam_tutup }}</p>
            @endforeach
        </div>

        <div class="">
            <h4 class="mb20">Pelayanan Pelanggan</h4>
            <a href="" class="block mb10">FAQ</a>
            <a href="" class="block mb10">Privacy Police</a>
        </div>

        <div class="">
            <h4 class="mb20">Perusahaan</h4>
            <a href="" class="block mb10">Tentang Kami</a>
        </div>

        <div class="mb20">
            <h4 class="mb20">Peta Lokasi</h4>
            {{-- <iframe src="https://maps.app.goo.gl/BitGVs8rUvDwLE6E7" frameborder="0" width="100%" allowfullscreen allow="geolocation"></iframe> --}}
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1762829194133!5m2!1sid!2sid!6m8!1m7!1s2QJ9LzEaYdiXGAhMPy4pNQ!2m2!1d-6.705947646683141!2d107.4979355594637!3f315.2544784956204!4f7.992260992244994!5f0.7820865974627469" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15846.675069223249!2d107.1559948!3d-6.8100844!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e691cb4f75177af%3A0x8ce4015760caed4a!2sJl.%20Wanayasa-Bojong-Sawit%2C%20Kabupaten%20Purwakarta%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1762830415522!5m2!1sid!2sid" width="100%" height="80%" style="border:6px solid dodgerblue; border-radius: 6px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>

    <div class="container-w1">
        <hr>
        <p class="text-small mt25 mb25">&copy;Ohayoy, All right reserved, Product by Taufik Hidayat</p>
    </div>
</footer>
