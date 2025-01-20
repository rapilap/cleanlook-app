<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\User;
use Illuminate\Http\Request;

class AccountListController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'courier');
        $search = $request->input('search');

        if ($type === 'courier') {
            // $user = Courier::all();
            $user = Courier::query();
            $dataType = 'courier';
            $title = 'Akun Kurir';
        } else {
            // $user = User::all();
            $user = User::query();
            $dataType = 'user'; 
            $title = 'Akun Pengguna';
        }

        $page = $user->when($search, function($query, $search) {
            $query->where('id', 'like', "%$search%")
            ->orWhere('name', 'like', "%$search%");
            // ->orWhere('plate_number', 'like', "%$search$");
        })->paginate(10);
 
        return view('admin.akun', compact('user', 'dataType', 'title', 'page'));
    }

    public function edit($id, Request $request)
    {
        $type = $request->get('type', 'courier');

        if ($type === 'courier') {
            $user = Courier::find($id);
            $dataType = 'courier';
        } else if ($type === 'user') {
            $user = User::find($id);
            $dataType = 'user';
        }
        // $user = Courier::find($id);

        return view('admin.edit', compact('user', 'dataType'));
    }

    public function create()
    {
        $dataType = 'courier'; // Default untuk kurir
        return view('admin.add', compact('dataType'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:couriers,email',
            'phone' => 'required|string|max:15',
            'birthdate' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'city' => 'required|string',
            'plate_number' => 'required|string',
            // 'password' => 'required|string|min:8|confirmed',
        ], [
            // Custom error messages
            'name.required' => 'Nama lengkap harap diisi.',
            'email.required' => 'Email harap diisi.',
            'phone.required' => 'Nomor telepon harap diisi.',
            'birthdate.required' => 'Tanggal lahir harap diisi.',
            'gender.required' => 'Jenis kelamin harap dipilih.',
            'address.required' => 'Alamat harap diisi.',
            'city.required' => 'Kota harap diisi.',
            'plate_number.required' => 'Plat nomor harap diisi.',
        ]);

        // Buat kurir baru
        Courier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'plate_number' => $request->plate_number,
            'password' => bcrypt('password'), // Enkripsi password
        ]);

        // Redirect ke halaman daftar kurir
        return redirect()->route('admin.index', ['type' => 'courier'])->with('success', 'Kurir berhasil ditambahkan!');
    }
}
