<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd('test');
        //  if(!Auth::check()){

        //     return redirect()->to('/');
        // }

        // 1. JIKA BELUM LOGIN: Langsung tendang ke halaman login utama
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. AMBIL ROLE USER YANG SEDANG LOGIN
        $roleName = Role::find(Auth::user()->role_id)->name;

        // 3. JIKA ROLE USER TIDAK COCOK dengan parameter di route
        if (!in_array($roleName, $roles)) {
            // Jika dia mengakses area yang salah, batalkan dan beri error 403 (Forbidden)
            abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        // 4. JIKA LOLOS SEMUA PENGECEKAN: Izinkan masuk ke halaman yang dituju
        return $next($request);
    }
}
