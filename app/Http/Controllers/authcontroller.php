<?php

namespace App\Http\Controllers;
use App\Models\Courier;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class authcontroller extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ], [
                'email.required' => 'E-mail harus diisi',
                'password.required' => 'Password harus diisi'
            ]
        ) ;
        $kurir = Courier::where('email', $request->email)->first();
        if ($kurir && Hash::check($request->password, $kurir->password)) {
            return redirect()->route('berandakurir');
        }
        
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return redirect()->route('berandauser');
        }
        return back()->withErrors(['message' => 'email atau password anda salah']);
    }
}