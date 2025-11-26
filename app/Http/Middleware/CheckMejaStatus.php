<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Meja;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMejaStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('meja')->check()) {
            $mejaSession = Auth::guard('meja')->user();
            $mejaDB = Meja::find($mejaSession->id);

            // if ($meja->status === 'kosong' && $meja->username === null) {
            //     Auth::guard('meja')->logout();
            //     $request->session()->invalidate();
            //     $request->session()->regenerateToken();

            //     return redirect()->route('thankyou');
            // }

             // JIKA USERNAME DI SESSION BERBEDA DENGAN DATABASE → BALAPAN SESI / USER BARU MASUK

            if($mejaSession->username !== $mejaDB->username){
                Auth::guard('meja')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('thankyou');
            }

            // $meja_terbaru = Meja::find($meja->id);
            if ($mejaDB->status !== 'terisi') {
                // Username berbeda → artinya sesi baru sudah mengambil meja
                Auth::guard('meja')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('thankyou');
            }
        }
        // elseif (!Auth::guard('meja')->check() && !Auth::guard('meja')->user()) {
        //     return redirect()->route('thankyou');
        // }

        // CEK BALAPAN SESI (USER BARU SUDAH LOGIN)

        return $next($request);
    }
}
