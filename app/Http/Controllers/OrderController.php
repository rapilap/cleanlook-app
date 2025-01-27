<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('berandauser');
    }

    public function payment(Request $request)
    {
        $request->request->add(['price'=>$request->price, 'status' => 'unpaid']);
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'courier_id' => null, // Belum ada kurir
            'category_id' => $request->type_sampah,
            'landfill_id' => $request->landfill,
            'pickup_lat' => $request->pickup_lat,
            'pickup_long' => $request->pickup_long,
            'address' => $request->alamat,
            'weight' => $request->berat,
            'price' => $request->price,
            'status' => 'unpaid',
        ]);

        // dd($transaction);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->price,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'last_name' => '',
                'phone' => $request->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('berandauser', compact('snapToken', 'transaction'));
    }
}
