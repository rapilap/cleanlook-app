<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Courier;

class CourierController extends Controller
{
    public function updateLocation(Request $request)
    {
        $user = Auth::guard('courier')->user();

        // Validasi data
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Update lokasi di database
        $user->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['success' => true]);
    }

    public function getLocation($id)
    {
        $courier = Courier::where('id', $id)->select('latitude', 'longitude')->first();

        if (!$courier) {
            return response()->json(['error' => 'Kurir tidak ditemukan'], 404);
        }

        return response()->json([
            'latitude' => $courier->latitude,
            'longitude' => $courier->longitude
        ]);
    }


}
