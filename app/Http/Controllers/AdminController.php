<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

use App\Models\Rating;
use App\Models\Roles;
use App\Models\User;
use App\Models\Meja;
use App\Models\Transaksi;
use App\Models\Toko;
use Illuminate\Http\Request;

// Export Excel
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;

class AdminController extends Controller
{

    protected function admin()
    {
        if (Auth::user()?->status === 'offline') {
            Auth::logout();
            Session::invalidate();
            Session::regenerateToken();
            return redirect()->route('login');
        }

        if (!Auth::check() or Auth::user()?->role_id !== 1) {
            abort(403, 'Akses ditolak');
        }
    }

    public function dashboard()
    {
        $this->admin();
        return view('admin.report'); // DIGANTI KE LAPORAN DARI DASHBOARD EFISIENSI HALAMAN
    }

    public function report()
    {
        $this->admin();


        $terlaris = Menu::orderBy('penjualan', 'desc')->take(5)->get();

        $tahun = date('Y');

        $bulans = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $totals = [];

        foreach (range(1, 12) as $bulan) {
            $total = Transaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->sum('total_bayar');

            $totals[] = $total;
        }

        return view('admin.report', compact('terlaris', 'totals', 'bulans', 'tahun'));
    }

    public function reportData()
    {
        $this->admin();

        // $mejaAktif = Meja::where('status', 'terisi')->count();
        // $meja = Meja::count();
        // $transaksi = Transaksi::count();
        // $pemasukan = Transaksi::sum('total_bayar');


        return response()->json([
            'mejaAktif' => Meja::where('status', 'terisi')->count(),
            'meja' => Meja::count(),
            'transaksi' => Transaksi::count(),
            'pemasukan' => Transaksi::where('tanggal', today())->sum('total_bayar'),
            'pemasukan_bulanan' => Transaksi::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total_bayar'),
            'pemasukan_tahunan' => Transaksi::WhereYear('created_at', now()->year)->sum('total_bayar')
        ]);
    }


    public function transaksi()
    {
        $this->admin();

        $transaksi = Transaksi::where('tanggal', today())->count();
        $transaksiAll = Transaksi::get()->count();

        // $data = Transaksi::latest()->get();
        $data = Transaksi::latest()->Paginate(15);

        $pemasukan = Transaksi::where('tanggal', today())->sum('total_bayar');
        $pemasukan_bulanan = Transaksi::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total_bayar');

        return view('admin.dataTransaksi', compact('transaksi', 'data', 'pemasukan', 'pemasukan_bulanan', 'transaksiAll'));
    }

    public function exportTransaksi()
    {
        $this->admin();

        return Excel::download(new TransaksiExport, 'OHAYOY_DATA_TRANSAKSI.xlsx');
    }


    public function kategoriMenu()
    {
        $this->admin();

        $kategoris = Kategori::all();
        return view('admin.kategoriMenu', compact('kategoris'));
    }

    public function tambahKategori(Request $request)
    {
        $this->admin();
        $request->validate([
            'nama_kategori' => 'required|string'
        ]);

        Kategori::create($request->all());
        return redirect()->route('admin.menu')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function hapusKategori($id)
    {
        $this->admin();
        Kategori::findOrFail($id)->delete();
        return redirect()->route('admin.menu')->with('success', 'Kategori berhasil dihapus!');
    }



    public function menu()
    {
        $this->admin();

        $kategoris = Kategori::latest()->get();

        $query = '';

        $menus = Menu::latest()->Paginate(20);

        // $menus = Menu::latest()->get();
        $terlaris = Menu::orderBy('penjualan', 'desc')->take(5)->get();
        return view('admin.menu', compact('query', 'kategoris', 'menus', 'terlaris'));
    }

    public function tambahMenu(Request $request)
    {
        $this->admin();
        $request->validate([
            'nama_menu' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            // 'stok' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $pathFoto = null;
        if ($request->hasFile('gambar_menu')) {
            $pathFoto = $request->file('gambar_menu')->store('menu', 'public');
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok ?? 0,
            'foto' => $pathFoto,
            'kategori_id' => $request->kategori_id,
        ]);
        return redirect()->route('admin.menu')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    public function hapusMenu($id)
    {
        $this->admin();
        Menu::findOrFail($id)->delete();
        return redirect()->route('admin.menu');
    }


    public function editMenu(Request $request)
    {
        $this->admin();

        $request->validate([
            'menu_id' => 'string|required',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'nama_menu' => 'string|required',
            'harga' => 'integer|required',
            'deskripsi' => 'string|required',
            'kategori_id' => 'required|exists:kategori,id'
        ]);


        $menu = Menu::where('id', $request->menu_id)->first();


        if ($request->hasFile('foto')) {
            if ($menu->foto && Storage::exists($menu->foto)) {
                Storage::delete($menu->foto);
                $path = $request->file('foto')->store('menu', 'public');
                $menu->foto = $path;
            };
        } elseif ($request->hasFile('foto') === '') {
            if ($menu->foto && Storage::exists($menu->foto)) {
                $path = $menu->foto;
                $menu->foto = $path;
            }
        }

        // $menu->foto = $path;
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;
        $menu->kategori_id = $request->kategori_id;
        $menu->save();

        return redirect()->route('admin.menu');
    }

    public function cariMenu()
    {
        $query = request()->query('query');

        $menus = Menu::where('nama_menu', 'like', '%' . $query . '%')->latest()->paginate(20);

        if(!$query){
            return redirect()->route('admin.menu');
        }

        $kategoris = Kategori::latest()->get();

        // $menus = Menu::latest()->Paginate(20);

        // $menus = Menu::latest()->get();
        $terlaris = Menu::orderBy('penjualan', 'desc')->take(5)->get();

        return view('admin.menu', compact('query', 'menus', 'kategoris', 'terlaris'));
    }


    public function ulasan($id)
    {
        $this->admin();

        $menu = Menu::where('id', $id)->withAvg('rating', 'nilai')->withCount('rating')->first();
        $ulasan = Rating::where('menu_id', $id)->latest()->get();

        // logika bintang

        return view('admin.rating', compact('menu', 'ulasan'));
    }

    public function editKategori(Request $request)
    {
        $this->admin();

        $request->validate([
            'nama_kategori' => 'string|required'
        ]);


        $kategori = Kategori::where('id', $request->kategori_id)->first();

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('admin.kategoriMenu');
    }

    public function menuStatus(Request $request)
    {
        $this->admin();

        $request->validate([
            'menu_id' => 'string|required',
            'status_stok' => 'string|required'
        ]);

        $menuStatus = Menu::where('id', $request->menu_id)->first();

        $menuStatus->status_stok = $request->status_stok;
        $menuStatus->save();

        return redirect()->route('admin.menu');
    }


    public function mejaData()
    {
        $this->admin();

        $meja = Meja::all();
        // $meja = Meja::latest()->Paginate(2);


        $oldUrl = Meja::orderBy('created_at', 'asc')->first();

        // QR Generator
        $qrcode = [];


        foreach ($meja as $m) {
            $hash = Hashids::connection('meja')->encode($m->id);
            if ($m->url) {
                $url = $m->url;
            } else {
                $oldUrl = Meja::whereNotNull('url')->orderBy('created_at', 'asc')->first();
                $url = $oldUrl ? $oldUrl->url : '/';
            }

            $m->url = $url;
            $m->save();

            $urlFull = url($url . '/' . $hash);


            // simpan hasil ke array
            $qrcode[] = [
                'meja' => $m,
                'url' => $urlFull,
                'qr' => QrCode::size(80)->generate($urlFull)
            ];
        }


        return response()->json([
            'qrcode' => $qrcode
        ]);
    }

    public function meja()
    {
        $this->admin();

        $query = '';

        $role = Roles::all();

        $default = Roles::where('nama_role', 'customer')->first();

        // $meja = Meja::all();
        // data tersortir berdasarkan tanggal bergantung pada filter meja kalau latest tersusun secara terbaru meski sudah dalam array


        $meja = Meja::all();

        $oldUrl = Meja::orderBy('created_at', 'asc')->first();

        // QR Generator
        $qrcode = [];


        foreach ($meja as $m) {
            $hash = Hashids::connection('meja')->encode($m->id);
            if ($m->url) {
                $url = $m->url;
            } else {
                $oldUrl = Meja::whereNotNull('url')->orderBy('created_at', 'asc')->first();
                $url = $oldUrl ? $oldUrl->url : '/';
            }

            $m->url = $url;
            $m->save();

            $urlFull = url($url . '/' . $hash);


            // simpan hasil ke array
            $qrcode[] = [
                'meja' => $m,
                'url' => $urlFull,
                'qr' => QrCode::size(80)->generate($urlFull)
            ];
        }

        return view('admin.meja', compact('query', 'role', 'default', 'qrcode'));
    }

    public function cariMeja()
    {
        $this->admin();

        $query = request()->query('query');

        $role = Roles::all();

        $default = Roles::where('nama_role', 'customer')->first();

        // $meja = Meja::all();
        // data tersortir berdasarkan tanggal bergantung pada filter meja kalau latest tersusun secara terbaru meski sudah dalam array

        if(!$query){
            return redirect()->route('admin.meja');
        }

        $meja = Meja::where('nama_meja', 'like', '%' . $query . '%')->get();


        $oldUrl = Meja::orderBy('created_at', 'asc')->first();

        // QR Generator
        $qrcode = [];


        foreach ($meja as $m) {
            $hash = Hashids::connection('meja')->encode($m->id);
            if ($m->url) {
                $url = $m->url;
            } else {
                $oldUrl = Meja::whereNotNull('url')->orderBy('created_at', 'asc')->first();
                $url = $oldUrl ? $oldUrl->url : '/';
            }

            $m->url = $url;
            $m->save();

            $urlFull = url($url . '/' . $hash);


            // simpan hasil ke array
            $qrcode[] = [
                'meja' => $m,
                'url' => $urlFull,
                'qr' => QrCode::size(80)->generate($urlFull)
            ];
        }

        return view('admin.meja', compact('query', 'role', 'default', 'qrcode'));
    }


    public function mejaRequest()
    {
        $this->admin();

        $mejaAktif = Meja::where('status', 'terisi')->orderBy('updated_at', 'desc')->get();

        return view('admin.meja_request', compact('mejaAktif'));
    }

    public function mejaReset(Request $request)
    {
        $this->admin();

        $request->validate([
            'meja_id' => 'required|exists:meja,id'
        ]);

        $meja = Meja::findOrFail($request->meja_id);

        $meja->update([
            'username' => null,
            'status' => 'kosong'
        ]);
        $meja->save();

        return redirect()->route('admin.meja_request');
    }


    public function printAllQr()
    {
        $this->admin();

        $meja = Meja::latest()->get();

        $qrcode = [];


        foreach ($meja as $m) {
            $hash = Hashids::connection('meja')->encode($m->id);
            if ($m->url) {
                $url = $m->url;
            } else {
                $oldUrl = Meja::whereNotNull('url')->orderBy('created_at', 'asc')->first();
                $url = $oldUrl ? $oldUrl->url : '/';
            }

            // $m->url = $url;
            // $m->save();

            $urlFull = url($url . '/' . $hash);


            // simpan hasil ke array
            $qrcode[] = [
                'meja' => $m,
                'url' => $urlFull,
                'qr' => QrCode::size(180)->generate($urlFull)
            ];
        }
        return view('admin.print_qrcode', compact('qrcode'));
    }

    public function print($id)
    {
        $this->admin();

        $meja = Meja::findOrfail($id);

        $qrcode = [];


        $hash = Hashids::connection('meja')->encode($meja->id);
        if ($meja->url) {
            $url = $meja->url;
        } else {
            $oldUrl = Meja::whereNotNull('url')->orderBy('created_at', 'asc')->first();
            $url = $oldUrl ? $oldUrl->url : '/';
        }

        // $m->url = $url;
        // $m->save();

        $urlFull = url($url . '/' . $hash);


        // simpan hasil ke array
        $qrcode[] = [
            'meja' => $meja,
            'url' => $urlFull,
            'qr' => QrCode::size(140)->generate($urlFull)
        ];

        return view('admin.print_qrcode', compact('qrcode'));
    }



    public function buatUrl(Request $request)
    {
        $this->admin();

        $request->validate([
            'url' => 'string|required'
        ]);

        Meja::query()->update(['url' => $request->url]);

        return redirect()->route('admin.meja');
    }


    public function tambahMeja(Request $request)
    {
        $this->admin();

        $request->validate([
            'nama_meja' => 'string|required',
            'password' => 'string|required',
            'role_id' => 'required|exists:roles,id'
        ]);

        Meja::create([
            'nama_meja' => $request->nama_meja,
            'password' => $request->password,
            'role_id' => $request->role_id
        ]);

        return redirect()->route('admin.meja');
    }

    public function hapusMeja($id)
    {
        $this->admin();

        Meja::findOrFail($id)->delete();

        return redirect()->route('admin.meja');
    }



    public function jam()
    {
        $this->admin();

        $jams = Jam::all();

        return view('admin.jam_operasional', compact('jams'));
    }

    public function editJam(Request $request)
    {
        $this->admin();

        // $request->validate([
        //     'jam_buka' => 'required',
        //     'jam_tutup' => 'required',
        //     // 'status' => 'required|boolean'
        // ]);

        $jam = Jam::where('id', $request->jam_id)->first();

        $jam->jam_buka = $request->jam_buka;
        $jam->jam_tutup = $request->jam_tutup;
        $jam->status = $request->status;
        $jam->save();

        return redirect()->route('admin.jam');
    }


    public function pengguna()
    {
        $this->admin();

        $query = null;
        $id = Auth::user()->id;
        $admin = User::findOrFail($id);
        $role = Roles::all();
        $user = User::all();
        return view('admin.pengguna', compact('query', 'role', 'user', 'admin'));
    }

    public function cariPengguna()
    {
        $this->admin();

        $query = request()->query('query');

        $id = Auth::user()->id;
        $admin = User::findOrFail($id);
        $role = Roles::all();
        $user = User::where('name', 'like', '%' . $query . '%')->get();

        if(!$query){
            return redirect()->route('admin.pengguna');
        }
        return view('admin.pengguna', compact('query', 'role', 'user', 'admin'));
    }

    public function editPengguna($id)
    {
        $this->admin();

        $user = User::findOrFail($id);

        return view('admin.editAkun', compact('user'));
    }

    public function editPenggunaPost(Request $request)
    {
        $this->admin();

        // $request->validate([
        //     'name' => 'required|string',
        //     'foto' => 'nullable|mimes:jpeg,jpg,png|max:5120'
        // ]);

        $user = User::findOrFail($request->id);

        $user->name = $request->name;

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
                $user->foto = $request->file('foto')->store('user', 'public');
            }else{
                $user->foto = $request->file('foto')->store('user', 'public');
            }
        }

        $user->save();

        return redirect()->route('admin.pengguna')->with('success', 'Data berhasil diperbarui');
    }

    public function tambahPengguna(Request $request)
    {
        $this->admin();

        $request->validate([
            'name' => 'string|required',
            'password' => 'string|required',
            'role_id' => 'required|exists:roles,id',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:5120'
        ]);

        $filePath = null;

        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('user', 'public');
        }
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'foto' => $filePath
        ]);

        return redirect()->route('admin.pengguna');
    }

    public function hapusPengguna($id)
    {
        $this->admin();

        User::findOrFail($id)->delete();

        return redirect()->route('admin.pengguna');
    }

    public function regeneratePass($id)
    {
        $this->admin();

        $user = User::findOrFail($id);

        $newPassword = Str::random(7);

        $user->password = Hash::make($newPassword);
        $user->status = 'offline';
        $user->save();


        return redirect()->back()->with('success', "Password Baru Untuk  $user->name: $newPassword");
    }


    public function toko()
    {
        $this->admin();

        $toko = Toko::latest()->first();

        return view('admin.toko', compact('toko'));
    }

    public function editToko()
    {
        $this->admin();

        $toko = Toko::latest()->first();

        return view('admin.special_page', compact('toko'));
    }

    public function editTokoPost(Request $request)
    {
        $this->admin();

        $request->validate([
            'id_toko' => 'integer|required',
            'nama_toko' => 'string',
            'tagline_toko' => 'string',
            'alamat_toko' => 'string',
            'website_toko' => 'string',
            'ucapan' => 'string',

        ]);

        $toko = Toko::findOrFail($request->id_toko);

        if ($toko) {
            $toko->nama_toko = $request->nama_toko;
            $toko->tagline_toko = $request->tagline_toko;
            $toko->alamat_toko = $request->alamat_toko;
            $toko->website_toko = $request->website_toko;
            $toko->ucapan = $request->ucapan;
            $toko->save();
        }

        return redirect()->route('admin.toko');
    }
}
