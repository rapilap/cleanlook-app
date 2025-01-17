<?php

namespace App\Http\Controllers;

use App\Models\Landfill;
use Illuminate\Http\Request;

class LandfillController extends Controller
{
    public function index()
    {
        $landfill = Landfill::query()
        ->orderBy('capacity', 'desc')->paginate(5);

        return view('admin.landfill.landfill', compact('landfill'));
    }
}
