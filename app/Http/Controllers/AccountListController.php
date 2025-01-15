<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\User;
use Illuminate\Http\Request;

class AccountListController extends Controller
{
    public function index(Request $request)
    {
         // Ambil parameter filter dari query string
         $type = $request->get('type');

         // Tentukan data yang akan diambil berdasarkan type
         if ($type === 'courier') {
             $user = Courier::all(); // Ambil semua data kurir dari tabel couriers
             $dataType = 'courier'; // Jenis data untuk view
         } else {
             $user = User::all(); // Ambil semua data pengguna dari tabel users
             $dataType = 'user'; // Jenis data untuk view
         }
 
         return view('admin.akun', compact('user', 'dataType'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.add', compact('user'));
    }
}
