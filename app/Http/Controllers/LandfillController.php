<?php

namespace App\Http\Controllers;

use App\Models\Landfill;
use Illuminate\Http\Request;

class LandfillController extends Controller
{
    public function index()
    {
        // Data untuk daftar di sidebar (dengan pagination)
        $landfillPaginated = Landfill::orderBy('name', 'asc')->paginate(10);

        // Data untuk peta (tanpa pagination)
        $landfillForMap = Landfill::orderBy('name', 'asc')
            ->select('id', 'name', 'address', 'capacity', 'latitude', 'longitude')
            ->get();

        return view('admin.landfill.landfill', [
            'landfill' => $landfillPaginated,
            'landfillForMap' => $landfillForMap,
        ]);
    }

    

}
