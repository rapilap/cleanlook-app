<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryAdminController extends Controller
{
    public function index(Request $request)
    {
        // Auth::user()->role === 'admin';

        $search = $request->input('search');

        $history = Transaction::with('category')
            ->when($search, function($query, $search) {
                $query->where('id', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        // $dAwal = $request->input('start-date');
        // $dAkhir = $request->input('end-date');
        // if ($dAwal && $dAkhir) {
        //     $history = Transaction::with('category')
        //     ->whereBetween('created_at', [$dAwal, $dAkhir])
        //     ->orderBy('id', 'desc')
        //     ->paginate(10);
        // }

        return view('admin.income.index', compact('history'));
    }
}
