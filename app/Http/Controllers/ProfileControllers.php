<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    // public function updateProfile(Request $request)
    // {
    //     // Ambil pengguna yang sedang login
    //     // dd($request);
    //     if (Auth::guard('courier')->check()) {
    //         $user = Auth::guard('courier')->user();
    //     } else {
    //         $user = Auth::user();
    //     }

    //     // Validasi data
    //     $request->validate([
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id . '|unique:couriers,email,' . $user->id,
    //         'address' => 'required|string|max:255',
    //         'phone' => 'required|string|max:15',
    //         'birthdate' => 'required|date',
    //         'gender' => 'required|in:L,P',
    //         'password' => 'nullable|string|min:8|confirmed'
    //     ]);

    //     $filename = null;
    //     if ($request->hasFile('image')) {
    //         // Hapus foto lama jika ada
    //         if ($user->image) {
    //             // Storage::delete('storage/' . $user->image);
    //             Storage::delete('public/uploads/' . $user->photo); // Hapus foto lama
    //         }
    
    //         // Simpan foto baru
    //         $file = $request->file('image');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         // $file->storeAs('storage/', $filename);
    //         $file->storeAs('public/uploads', $filename); // Simpan ke "storage/app/public/uploads"
    
    //         // Simpan path ke database
    //         // $user->image = $filename;
    //         $user->image = 'uploads/' . $filename;

    //     }

    //     // Update data
    //     $user->update([
    //         'image' => $filename,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'address' => $request->address,
    //         'phone' => $request->phone,
    //         'birthdate' => $request->birthdate,
    //         'gender' => $request->gender,
    //         'password' => $request->password ? Hash::make($request->password) : $user->password, // Jaga password tetap sama jika tidak diubah
    //     ]);

    //     return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    // }

    public function updateProfile(Request $request)
    {
        if (Auth::guard('courier')->check()) {
            $user = Auth::guard('courier')->user();
        } else {
            $user = Auth::user();
        }

        // Validasi
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|unique:couriers,email,' . $user->id,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'birthdate' => 'required|date',
            'gender' => 'required|in:L,P',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        // Proses upload gambar
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image) {
                Storage::delete('public/uploads/' . $user->image);
            }

            // Simpan foto baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);

            // Simpan path ke database
            $user->update(['image' => 'uploads/' . $filename]);

        }

        // Update data pengguna
        $user->update([
            'image' => $user->image,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

}
