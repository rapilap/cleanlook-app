<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCourierController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('courier')->attempt($credentials)) {
            return redirect('/courier/home'); // Redirect ke halaman dashboard kurir
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('courier')->logout();
        return redirect('/courier')->with('success', 'Logout berhasil!');
    }
}
