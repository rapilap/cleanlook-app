<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HistoryCourierController extends Controller
{
    // Mendapatkan semua transaksi
    public function index()
{
    $user = Auth::guard('courier')->user();
    $id_courier = $user->id;

    // Ambil tanggal hari ini
    $today = Carbon::today();

    // Ambil riwayat transaksi untuk kurir berdasarkan hari ini
    $history_courier = Transaction::with('courier')
        ->where('courier_id', $id_courier)
        ->orderBy('id', 'asc')
        ->get();

    // Ambil total pendapatan saat ini berdasarkan transaksi hari ini
    $totalPendapatan = Transaction::where('courier_id', $id_courier)
        ->whereDate('date', $today)
        ->sum('price'); // Asumsi `price` adalah total pembayaran dari transaksi

    // Ambil pemasukan terakhir dari transaksi terakhir hari ini
    $lastTransaction = Transaction::where('courier_id', $id_courier)
    ->whereDate('created_at', $today)
    ->latest('created_at')
    ->first();

    // Ambil harga transaksi terakhir
    $lastTransactionPrice = $lastTransaction ? $lastTransaction->price : 0;

    return view('courier.pendapatan', compact('history_courier', 'user', 'today', 'lastTransactionPrice', 'totalPendapatan'));
}

}


