<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HistoryCourierController extends Controller
{
    
    public function index()
    {
        $user = Auth::guard('courier')->user();
        $id_courier = $user->id;

        $today = Carbon::today();

        $history_courier = Transaction::with('courier')
            ->where('courier_id', $id_courier)
            ->orderBy('id', 'desc')
            ->get();

        $totalPendapatan = Transaction::where('courier_id', $id_courier)
            ->whereDate('date', $today)
            ->sum('price');

        $lastTransaction = Transaction::where('courier_id', $id_courier)
        ->whereDate('created_at', $today)
        ->latest('created_at')
        ->first();

        $lastTransactionPrice = $lastTransaction ? $lastTransaction->price : 0;

        return view('courier.pendapatan', compact('history_courier', 'user', 'today', 'lastTransactionPrice', 'totalPendapatan'));
    }

}


