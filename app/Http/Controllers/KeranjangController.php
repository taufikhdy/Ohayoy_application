<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Roles;
use App\Models\User;
use App\Models\Meja;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class KeranjangController extends Controller
{
    //

    protected function customer()
    {
        if (!Auth::guard('meja')->check() or Auth::guard('meja')->user()->role_id !== 3) {
            abort(403, 'Akses ditolak');
        }
    }



    public function tambahKeranjang(Request $request)
    {

        // $mejaId = Auth::guard('meja')->id();

        $request->validate([
            'meja_id' => 'required|exists:meja,id',
            'menu_id' => 'required|exists:menu,id',
            'jumlah' => 'integer|min:1'
        ]);


        $keranjang = Keranjang::firstOrCreate(
            ['meja_id' => $request->meja_id, 'status' => 'active'],
            ['status' => 'active']
        );

        // $keranjang = Keranjang::where('meja_id', $mejaId)->where('status', 'active')->first();

        // if(!$keranjang){
        //     Keranjang::create([
        //         'meja_id' => $request->meja_id,
        //         'status' => 'active'
        //     ]);
        // }


        //////


        $item = KeranjangItem::where('keranjang_id', $keranjang->id)->where('menu_id', $request->menu_id)->first();


        if ($item) {
            $item->update([
                'jumlah' => $item->jumlah += $request->jumlah
            ]);
        } else {
            KeranjangItem::create([
                'keranjang_id' => $keranjang->id,
                'menu_id' => $request->menu_id,
                'jumlah' => $request->jumlah
            ]);
        }

        // return response()->json(['message' => 'Item berhasil ditambahkan ke keranjang']);
        // return redirect()->back();
        return redirect()->route('customer.detailMenu', ['id' => $request->menu_id])->withSuccess('Menu berhasil ditambahkan ke keranjang, yuk pesan sekarang 🍟🥤');
    }
}
