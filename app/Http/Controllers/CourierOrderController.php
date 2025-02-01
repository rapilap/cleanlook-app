<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierOrderController extends Controller
{
    public function index()
    {
        $courier = Auth::guard('courier')->user();

        $idCourier = $courier->id;

        $order = Transaction::with(['courier', 'user', 'landfill'])
            ->where('courier_id', null)
            ->get();

        $history = Transaction::with(['courier', 'user', 'landfill'])
            ->where('courier_id', $idCourier)
            ->get();

        return view('berandakurir', compact(['courier', 'order', 'history']));
    }

    public function accept(Request $request, $id)
    {
        $order = Transaction::findOrFail($id);

        // Update status menjadi "pickup" dan tambahkan courier_id
        $order->update([
            'status' => 'pickup',
            'courier_id' => Auth::id(),
        ]);
    
        return view('courier.courierOrder', compact('order'));

    }

    // public function maps($id)
    // {
    //     $order = Transaction::findOrFail($id);

    //     return view('tracking', compact('order'));
    // }

}
