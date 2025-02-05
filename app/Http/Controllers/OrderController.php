<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('user.home')->with('warning', 'Silakan verifikasi email Anda untuk melanjutkan.');
        }
        
        return view('berandauser',compact('category'));
    }
    
    public function payment(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'berat' => 'required',
        ], [
            'alamat.required' => 'Alamat harap diisi.',
            'berat.required' => 'Berat harap diisi.',
        ]);

        $request->request->add(['price' => $request->price, 'status' => 'unpaid']);
        
        $order_id = 'CL-' . time() . '-' . uniqid();

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'courier_id' => null,
            'category_id' => $request->type_sampah,
            'landfill_id' => $request->landfill,
            'date' => now(),
            'pickup_lat' => $request->pickup_lat,
            'pickup_long' => $request->pickup_long,
            'address' => $request->alamat,
            'weight' => $request->berat,
            'price' => $request->price,
            'status' => 'unpaid',
            'order_id' => $order_id, // Langsung masukkan order_id
        ]);

        $user = Auth::user();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $transaction->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'last_name' => '',
                'phone' => $user->phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

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
        // dd($request->all());
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = Transaction::where('order_id', $request->order_id)->first();
    
                if ($order) { // Cek apakah transaksi ditemukan
                    $order->update(['status' => 'searching']);
                } else {
                    Log::error('Transaction not found: ' . $request->order_id);
                }
            }
        }
    }
    
}
