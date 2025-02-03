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
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        $courier = Auth::user();
        $courier->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    
        return back();
    }
}
