<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryAdminController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');

        $query = Transaction::with('category');

        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        if ($search) {
            $query->whereHas('category', function ($q) use ($search) {
                $q->where('cat_name', 'like', "%$search%");
            });
        }

        // Paginate data
        $history = $query->orderBy('date', 'desc')->paginate(10);

        return view('admin.income.index', compact('history'));
    }
}
