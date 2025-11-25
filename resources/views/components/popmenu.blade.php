{{-- <a href="#popData" class="popMenu">
    <i class="ri-add-large-line"></i>
</a> --}}

<div class="popData text-small flex fd-column gap10" id="popData">
    <a href="{{ route('exportMenu') }}" class="popLink {{ Request::is('admin/database/menu*') ? 'active' : '' }}"><i
            class="ri-file-download-line"></i> Export Data Menu</a>
    {{-- <a href="{{ route('exportTransaksi') }}"
        class="popLink {{ Request::is('admin/database/transaksi*') ? 'active' : '' }}"><i
            class="ri-file-download-line"></i> Export Data Transaksi</a> --}}

    <div class="{{ Request::is('admin/database/transaksi*') ? 'active' : '' }}">
        <form action="{{ route('exportTransaksi') }}" method="GET">

            <div class="flex align-center fd-column gap10 w-100">
                {{-- <label>Dari tanggal</label> --}}
                <input type="date" name="from" required class="p5">

                {{-- <label>Sampai tanggal</label> --}}
                <input type="date" name="to" required class="p5">

                <input type="submit" class="btn-blue" value="Export Data Transaksi"></input>
            </div>
        </form>
    </div>

    <a href="{{ route('admin.pengguna') }}"
        class="popLink {{ Request::is('admin/database/pengguna*') ? 'active' : '' }}"><i
            class="ri-file-download-line"></i> Export Data Menu</a>
</div>
