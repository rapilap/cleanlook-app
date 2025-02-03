<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfYear()->toDateString();
            $endDate = Carbon::now()->toDateString();
        }

        $periode = Carbon::parse($startDate)->translatedFormat('d M Y') . " - " . Carbon::parse($endDate)->translatedFormat('d M Y');

        $currentRevenue = Transaction::whereBetween('date', [$startDate, $endDate])
            ->whereNotNull('courier_id')
            ->sum('price');

        $topCourier = Transaction::whereBetween('date', [$startDate, $endDate])
            ->whereNotNull('courier_id')
            ->select('courier_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('courier_id')
            ->orderByDesc('total_orders')
            ->with('courier')
            ->first();

        $currentWaste = Transaction::whereBetween('date', [$startDate, $endDate])
            ->select('category_id', DB::raw('SUM(weight) as total_weight'))
            ->groupBy('category_id')
            ->orderByDesc('total_weight')
            ->with('category')
            ->first();

        $currentTPS = Transaction::whereBetween('date', [$startDate, $endDate])
            ->select('landfill_id', DB::raw('SUM(weight) as total_tps'))
            ->groupBy('landfill_id')
            ->orderByDesc('total_tps')
            ->with('landfill')
            ->first();

        return view('admin.dashboard', [
            'periode' => $periode,
            'currentWaste' => $currentWaste,
            'currentTPS' => $currentTPS,
            'topCourier' => $topCourier,
            'currentRevenue' => $currentRevenue,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
