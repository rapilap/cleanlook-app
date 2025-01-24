<?php

namespace App\Http\Controllers;

use App\Models\Landfill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandfillController extends Controller
{
    public function index(Request $request)
    {
        // Data untuk daftar di sidebar (dengan pagination)
        // $landfillPaginated = Landfill::orderBy('name', 'asc')->paginate(10);

        // Data untuk peta (tanpa pagination)
        $search = $request->input('search');

        $landfillForMap = Landfill::orderBy('name', 'asc')
            ->select('id', 'name', 'address', 'capacity', 'latitude', 'longitude')
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%$search%");
            })->get();

        return view('admin.landfill.landfill', [
            // 'landfill' => $landfillPaginated,
            'landfill' => $landfillForMap,
        ]);
    }

    public function create()
    {
        return view('admin.landfill.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'capacity' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'name.required' => 'Nama wajib diisi',
            'address.required' => 'Alamat wajib diisi',
            'capacity.required' => 'Kapasitas wajib diisi',
            'latitude.required' => 'Peta wajib diisi',
            'longitude.required' => 'Peta wajib diisi',
        ]);

        Landfill::create([
            'name' => $request->name,
            'address' => $request->address,
            'capacity' => $request->capacity,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('landfill.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $landfill = Landfill::find($id);
        return view('admin.landfill.edit', compact('landfill'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        $landfill = Landfill::find($id);
        if (!$landfill) {
            return redirect()->route('landfill.index')->with('error', 'Data tidak ditemukan.');
        }
    
        $landfill->update($request->all());
    
        return redirect()->route('landfill.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $landfill = Landfill::find($id);
        if (!$landfill) {
            return redirect()->route('landfill.index')->with('error', 'Data tidak ditemukan');
        }

        $landfill->delete();

        return redirect()->route('landfill.index')->with('success', 'Data berhasil dihapus');
    }

    public function getNearbyLandfills(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $landfills = Landfill::select(
            'id',
            'name',
            'address',
            'latitude',
            'longitude',
            'capacity',
            DB::raw("(
                6371 * acos(
                    cos(radians($latitude)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians($longitude)) +
                    sin(radians($latitude)) *
                    sin(radians(latitude))
                )
            ) AS distance")
        )
        ->orderBy('distance', 'asc') // Urutkan berdasarkan jarak
        ->limit(5) // Ambil hanya 5 TPS terdekat
        ->get();

        return response()->json($landfills);
    }

    public function show($id)
    {
        $landfill = Landfill::find($id);

        if (!$landfill) {
            return response()->json(['error' => 'TPS tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $landfill->id,
            'name' => $landfill->name,
            'latitude' => $landfill->latitude,
            'longitude' => $landfill->longitude,
            'address' => $landfill->address,
        ]);
    }

}
