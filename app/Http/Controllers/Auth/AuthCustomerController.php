<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jam;
use App\Models\Meja;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Vinkla\Hashids\Facades\Hashids;


use Illuminate\Support\Facades\Session;


class AuthCustomerController extends Controller
{
    //

    public function wrongHours()
    {
        return view('components.wrongHours');
    }

    public function wrongway()
    {
        return view('components.wrongway');
    }

    public function thankyou()
    {
        return view('components.thankyou');
    }

    public function loginByQr(Request $request, $hash)
    {
        $jam = Jam::where('hari', now()->format('l'))->first();

        if ($jam && $jam->status === 1) {
            $sekarang = now()->format('H:i:s');

            if ($sekarang < $jam->jam_buka || $sekarang > $jam->jam_tutup) {
                return redirect()->route('wrongHours');
            }
        } elseif ($jam->status === 0) {
            return redirect()->route('wrongHours');
        }

        $id = Hashids::connection('meja')->decode($hash)[0] ?? null;

        if (!$id) {
            return view('components.wrongway');
        }

        $meja = Meja::find($id);

        if (!$meja) {
            return view('components.wrongway');
        } elseif ($meja && $meja->status === 'terisi' && $meja->username !== null){
            return view('components.mejaFilled', compact('id'));
        }

        $request->session()->regenerate();
        Auth::guard('meja')->login($meja);

        $id_customer = Auth::guard('meja')->user()->id;

        $customer = Meja::findOrFail($id_customer);
        $customer->status = 'terisi';
        $customer->save();

        if (Auth::guard('meja')->user()->username === null) {
            return redirect()->route('customer.form');
        }
        // if (
        //     Auth::guard('meja')->user()->username === null &&
        //     Auth::guard('meja')->user()->status === 'kosong'
        // ) {
        //     $meja->update([
        //         'username' => null,
        //         'status' => 'kosong'
        //     ]);
        //     $meja->save();

        //     Auth::guard('meja')->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();

        //     return redirect()->route('');
        // }

        return redirect()->route('customer.dashboard');
    }

    public function resetMeja(Request $request)
    {
        $request->validate([
            'meja_id' => 'required'
        ]);

        $meja = Meja::findOrFail($request->id);

        $meja->request = 'request';
        $meja->save();

        return redirect()->back()->with('success', 'Permintaan Terkirim');
    }

    public function logout(Request $request): RedirectResponse
    {
        $id = $request->id_user;

        $meja = meja::findOrFail($id);

        $orders = Order::where('meja_id', $id)->latest()->first();
        $keranjangs = Keranjang::where('meja_id', $id);

        if ($orders) {
            return redirect()->route('customer.dashboard')->with('error', 'Tidak bisa keluar, kamu sedang memesan menu 😓');
        } elseif (!$orders) {

            $meja->update([
                'username' => null,
                'status' => 'kosong'
            ]);
            $meja->save();

            Auth::guard('meja')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('thankyou')
                ->withSuccess('Logout berhasil!');
        }
    }
}
