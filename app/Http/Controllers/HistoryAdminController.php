<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryAdminController extends Controller
{
    public function index()
    {
        // Auth::user()->role === 'admin';
        $history = Transaction::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.income.index', compact('history'));
    }
}
