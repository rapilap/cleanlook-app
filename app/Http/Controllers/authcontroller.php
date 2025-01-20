<?php

namespace App\Http\Controllers;
use App\Models\Courier;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:user,courier',
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->role;

        $guard = $role === 'user' ? 'user' : ($role === 'courier' ? 'courier' : null);

        if (!$guard) {
            return back()->withErrors(['role' => 'Role tidak valid.']);
        }

        if (Auth::guard($guard)->attempt($credentials)) {
            $user = Auth::guard($guard)->user();

            // Cek apakah admin
            if ($role === 'user' && $user->is_admin) {
                return redirect('/admin/dashboard');
            }

            // Redirect berdasarkan role
            return $role === 'user' ? redirect('/berandauser') : redirect('/berandakurir');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
}