<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next, $role)
    {
        // Periksa guard yang aktif
        $guard = Auth::guard('user')->check() ? 'user' : (Auth::guard('courier')->check() ? 'courier' : null);

        if (!$guard) {
            return redirect('/register')->withErrors(['message' => 'Akses ditolak. Silakan login terlebih dahulu.']);
        }

        // Ambil pengguna yang sedang login
        $user = Auth::guard($guard)->user();

        // Validasi role
        if ($role === 'admin') {
            if (!$user || !$user->is_admin) {
                return redirect('/register')->withErrors(['message' => 'Akses ditolak. Anda bukan admin.']);
            }
        } elseif ($role === 'user') {
            if (!$user || $user->is_admin) {
                return redirect('/register')->withErrors(['message' => 'Akses ditolak. Anda tidak memiliki akses sebagai user.']);
            }
        } elseif ($role === 'courier') {
            if ($guard !== 'courier') {
                return redirect('/register')->withErrors(['message' => 'Akses ditolak. Anda tidak memiliki akses sebagai kurir.']);
            }
        }

        return $next($request);
    }

}
