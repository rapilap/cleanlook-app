<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return redirect()->intended($user->role === 'admin' ? route('admin.dashboard') : route('user.home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
                'max:255',
            ],
            'email' => 'required|email|unique:users,email|max:255',
            'password' => [
                'required',
                'min:6',
                'regex:/[0-9]/', // Harus mengandung angka
            ],
        ], [
            // Custom error messages
            'name.required' => 'Nama harus diisi.',
            'name.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
    
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
            'password.regex' => 'Password harus mengandung minimal 1 angka.',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

        Auth::attempt($request->only('email', 'password'));

        return redirect('/home')->with('success', 'Data berhasil dibuat!');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
