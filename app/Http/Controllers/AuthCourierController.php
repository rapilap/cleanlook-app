<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCourierController extends Controller
{
    public function courierLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // Login menggunakan guard 'courier'
    if (Auth::guard('courier')->attempt($credentials)) {
        return redirect('/courier/dashboard');
    }

    return back()->withErrors(['message' => 'Email atau password salah.']);
}
}
