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

        // Cek apakah kurir sudah mengambil pesanan
        $activeOrders = Transaction::with(['courier', 'user', 'landfill'])
            ->where('courier_id', $idCourier)
            ->whereNotIn('status', ['completed'])
            ->get(); // Ambil 1 pesanan yang sedang berjalan

        // Jika kurir belum mengambil pesanan, tampilkan semua yang courier_id = null
        $order = $activeOrder ? collect([]) : Transaction::with(['courier', 'user', 'landfill'])
            ->whereIn('status', ['searching'])
            ->whereNull('courier_id')
            ->get();

        return view('berandakurir', compact(['courier', 'order', 'activeOrder']));
    }

    public function accept(Request $request, $id)
    {
        $courier = Auth::guard('courier')->user();

        // Cek apakah kurir sudah mengambil pesanan lain yang belum selesai
        $existingOrder = Transaction::where('courier_id', $courier->id)
            ->whereNotIn('status', ['completed'])
            ->first();
    
        if ($existingOrder) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pesanan yang sedang berjalan.');
        }
    
        // Assign pesanan ke kurir
        $order = Transaction::findOrFail($id);
        $order->update(['courier_id' => $courier->id, 'status' => 'pickup']);
    
        return view('courier.courierOrder', compact('order'))->with('success', 'Pesanan berhasil diambil!');

    }

    public function detail($id)
    {
        $order = Transaction::findOrFail($id);

        return view('courier.courierOrder', compact('order'));
    }

    public function updateStatus(Request $request, $id) {
        $order = Transaction::findOrFail($id);
        $order->update(['status' => $request->status]);

        if ($request->status === 'completed') {
            return redirect()->route('courier.home')->with('success', 'Pesanan telah selesai.');
        }
    
        return back();
    }
    
}
