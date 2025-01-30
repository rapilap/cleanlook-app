<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryUserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::id();
        $search = $request->query('search');

        $ongoingOrders = Transaction::with(['landfill', 'courier'])
            ->where('user_id', $user)
            ->whereIn('status', ['searching', 'pickup', 'deliver'])
            ->get();

        $historyQuery = Transaction::with('landfill')
            ->where('user_id', $user)
            ->where('status', 'completed');

        if (!empty($search)) {
            $historyQuery->where(function ($query) use ($search) {
                $query
                    ->Where('date', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%");
            });
        }
    
        $history = $historyQuery->get();

        return view('user.history', compact('ongoingOrders', 'history', 'search'));
    }

}
