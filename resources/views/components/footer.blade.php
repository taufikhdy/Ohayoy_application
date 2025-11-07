<footer>
    <div class="container-w3 w100 gap25">
        <div class="">
            <a href="http://cafe_web.test/customer/dashboard" class="">
                <h1>Ohayoy</h1>
            </a>
            <p class="title-box">{{ $toko->alamat_toko }}</p>
            @foreach ($jam as $j)
                <p class="text-small mb10">{{ $j->hari . ' : ' . $j->jam_buka . ' -   ' . $j->jam_tutup }}</p>
            @endforeach
        </div>

        <div class="">
            <h4 class="mb20">Customer Service</h4>
            <a href="" class="block mb10">FAQ</a>
            <a href="" class="block mb10">Privacy Police</a>
        </div>

        <div class="mb20">
            <h4 class="mb20">Company</h4>
            <a href="" class="block mb10">About Us</a>
        </div>
    </div>

    <div class="container-w1">
        <hr>
        <p class="text-small mt25 mb25">&copy;Ohayoy, All right reserved, Product by taufik_hdy</p>
    </div>
</footer>
