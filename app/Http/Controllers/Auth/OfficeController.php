<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;


class OfficeController extends Controller
{

    public function login()
    {

        if (Auth::user()?->role_id === 1) {
            return redirect()->route('admin.report');
        } elseif (Auth::user()?->role_id === 2) {
            return view('kasir.pesanan');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $id = Auth::user()->id;
            $user = User::findOrFail($id);

            $user->status = 'online';
            $user->save();

            $role = Auth::user()?->role_id;

            return match ($role) {
                1 => redirect()->route('admin.report'),
                2 => redirect()->route('kasir.pesanan'),
                3 => redirect()->route('customer.dashboard'),
                default => redirect()->route('login')
            };

        }



        $username = User::where('name', $request->name)->first();

        if (!$username) {
            return redirect()->back()->with('name', 'Username tidak ditemukan');
        }
        return redirect()->back()->with('password', 'Password yang anda masukkan salah');
    }


    public function logout(Request $request): RedirectResponse
    {
        $id = $request->id_user;
        $user = User::findOrFail($id);
        $user->status = 'offline';
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Logout berhasil!');
    }
}
