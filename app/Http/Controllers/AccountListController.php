<?php

namespace App\Http\Controllers;

use App\Mail\CourierAccountMail;
use App\Models\Courier;
use App\Models\CourierLog;
use App\Models\Transaction;
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
        
        // Ambil bulan saat ini
        $currentMonth = now()->format('Y-m');
        $formattedMonth = now()->format('F Y');

        if ($type === 'courier') {
            $user = Courier::find($id);

            // Hitung total pesanan yang dilakukan oleh kurir di bulan ini
            $totalT = Transaction::where('courier_id', $user->id)
                ->whereDate('date', 'like', "$currentMonth%")
                ->whereIn('status', ['completed'])
                ->count();

            // Hitung total pemasukan kurir di bulan ini
            $totalIncome = Transaction::where('courier_id', $user->id)
                ->whereDate('date', 'like', "$currentMonth%")
                ->whereIn('status', ['completed'])
                ->sum('price');

            $dataType = 'courier';
        } else if ($type === 'user') {
            $user = User::find($id);

            // Hitung total pesanan yang dilakukan oleh user di bulan ini
            $totalT = Transaction::where('user_id', $user->id)
                ->whereDate('date', 'like', "$currentMonth%")
                ->count();

            // Hitung total pengeluaran user di bulan ini
            $totalIncome = Transaction::where('user_id', $user->id)
                ->whereDate('date', 'like', "$currentMonth%")
                ->sum('price');

            $dataType = 'user';
        }

        return view('admin.edit', compact('user', 'dataType', 'formattedMonth', 'totalT', 'totalIncome'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email:rfc,dns|unique:couriers,email',
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
            'image.required' => 'Foto harap diisi',
            'name.required' => 'Nama lengkap harap diisi.',
            'email.required' => 'Email harap diisi.',
            'phone.required' => 'Nomor telepon harap diisi.',
            'birthdate.required' => 'Tanggal lahir harap diisi.',
            'gender.required' => 'Jenis kelamin harap dipilih.',
            'address.required' => 'Alamat harap diisi.',
            'city.required' => 'Kota harap diisi.',
            'plate_number.required' => 'Plat nomor harap diisi.',
        ]);

        $request->merge([
            'email' => strtolower(trim($request->email)),
        ]);
        
        $password = Str::random(8);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // dd($file);
            $filename = time() . '_' . $file->getClientOriginalName();
            $filename = $file->store('uploads', 'public');
        }

        // Buat kurir baru
        $courier = Courier::create([
            'image' => $filename,
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

    public function summary()
    {

    }
}
