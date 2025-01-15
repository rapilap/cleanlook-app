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
        // $search = $request->input('search');

        if ($type === 'courier') {
            $user = Courier::all();
            $dataType = 'courier';
            $title = 'Akun Kurir';
        } else {
            $user = User::all();
            $dataType = 'user'; 
            $title = 'Akun Pengguna';
        }
 
        return view('admin.akun', compact('user', 'dataType', 'title'));
    }

    public function edit($id)
    {
        $user = Courier::find($id);

        return view('admin.add', compact('user'));
    }
}
