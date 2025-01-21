<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,user', // Tambahkan validasi untuk role
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        // Login menggunakan guard 'web'
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            if ($user->role === $role) {
                if ($role === 'admin') {
                    return redirect('/admin/dashboard');
                }

                if ($role === 'user') {
                    return redirect('/berandauser');
                }
            }

            Auth::guard('web')->logout(); // Logout jika role tidak sesuai
        }

        return back()->withErrors(['message' => 'Email atau password salah, atau role tidak sesuai.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect()->route('loginView')->with('success', 'Data berhasil dibuat!');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
