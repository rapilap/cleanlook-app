<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HistoryCourierController extends Controller
{
    // Mendapatkan semua transaksi
    public function index()

    {
        $user = Auth::guard('courier')->user();
        $id_courier = $user->id;
        $history_courier = Transaction::with('courier')->where('courier_id', $id_courier)->get();
        return view('courier.pendapatan',compact('history_courier','user'));
        
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
        ]);

        $transaction = new Transaction([
            'user' => $request->user,
            'amount' => $request->amount,
            'type' => $request->type,
        ]);

        $transaction->save();

        return response()->json([
            'message' => 'Transaction added successfully',
            'transaction' => $transaction
        ], 201);
    }


    // Menghapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();
        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}


