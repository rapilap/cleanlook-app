<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCourierController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('courier')->attempt($credentials)) {
            return redirect('/courier/berandakurir'); // Redirect ke halaman dashboard kurir
        }

        return back()->withErrors(['message' => 'Email atau password salah.']);
    }
}
