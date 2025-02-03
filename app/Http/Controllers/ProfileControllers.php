<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileControllers extends Controller
{
    public function index($id)
    {
        $data = '';
        if (Auth::guard('courier')->check()) {
            $data = Courier::findOrFail($id);
        } else {
            $data = User::findOrFail($id);
        }

        return view('detailprofile', compact('data'));
    }

    public function updateProfile(Request $request)
    {
        // Ambil pengguna yang sedang login
        // dd($request);
        if (Auth::guard('courier')->check()) {
            $user = Auth::guard('courier')->user();
        } else {
            $user = Auth::user();
        }

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|unique:couriers,email,' . $user->id,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'birthdate' => 'required|date',
            'gender' => 'required|in:L,P',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        // Update data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Jaga password tetap sama jika tidak diubah
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
