<?php

namespace App\Http\Controllers;

use App\Mail\CourierAccountMail;
use App\Models\Courier;
use App\Models\CourierLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountListController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'courier'); // Default ke courier jika tidak ada type
        $search = $request->input('search');

        // Query data berdasarkan type
        if ($type === 'courier') {
            $query = Courier::query();
            $title = 'Akun kurir';
        } else {
            $query = User::query();
            $title = 'Akun pengguna';
        }

        // Tambahkan filter pencarian jika ada
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('id', 'like', "%$search%");
            });
        }

        $page = $query->paginate(10);

        return view('admin.akun', compact('page', 'type', 'title'))->with([
            'dataType' => $type,
        ]);
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

        $password = Str::random(8);

        // Buat kurir baru
        $courier = Courier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'plate_number' => $request->plate_number,
            'password' => bcrypt($password), // Enkripsi password
        ]);

        Mail::to($courier->email)->send(new CourierAccountMail($courier, $password));

        // Redirect ke halaman daftar kurir
        return redirect()->route('admin.index', ['type' => 'courier'])->with('success', 'Kurir berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $courier = Courier::findOrFail($id);

        CourierLog::create([
            'courier_id'   => $courier->id,
            'name'         => $courier->name,
            'email'        => $courier->email,
            'phone'        => $courier->phone,
            'birthdate'    => $courier->birthdate,
            'gender'       => $courier->gender,
            'address'      => $courier->address,
            'city'         => $courier->city,
            'plate_number' => $courier->plate_number,
            // 'deleted_at'   => now() 
        ]);

        $courier->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.index', ['type' => 'courier'])
            ->with('success', 'Akun kurir berhasil dihapus dan disimpan di log.');
    }
}
