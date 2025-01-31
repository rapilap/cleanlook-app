<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $category = Category::all();
        
        return view('berandauser',compact('category'));
    }

    
    public function payment(Request $request)
    {
        
        $request->request->add(['price'=>$request->price, 'status' => 'unpaid']);
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'courier_id' => null, // Belum ada kurir
            'category_id' => $request->type_sampah,
            'landfill_id' => $request->landfill,
            'date'=>now(),
            'pickup_lat' => $request->pickup_lat,
            'pickup_long' => $request->pickup_long,
            'address' => $request->alamat,
            'weight' => $request->berat,
            'price' => $request->price,
            'status' => 'unpaid',
        ]);

        $user = Auth::user();
        
        // dd($transaction);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
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
                'first_name' => $user->name,
                'last_name' => '',
                'phone' => $user->phone,
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // dd($snapToken, $transaction);
        return view('checkout', compact('snapToken', 'transaction'));
    }
    
    public function calculateTotal($category_id, $weight, $distance)
    {
        // Ambil kategori dari database
        $category = Category::find($category_id);
    
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    
        // Hitung total harga
        $categoryPrice = $category->cat_price; // Harga per kg
        $distanceCost = $distance * 5000; // Biaya per km
        $weightCost = $weight * $categoryPrice; // Biaya per kg
        $totalPrice = ceil($distanceCost + $weightCost); // Total harga
    
        return $totalPrice;
    }

    public function callback(Request $request) {
        dd($request->all());
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $order = Transaction::find($request->order_id);
                $order->update(['status' => 'searching']);
            }
        }
    }
}
