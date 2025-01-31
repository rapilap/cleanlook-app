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
        // Ambil filter dari request, default ke 'month'
        $filterType = $request->query('filter', 'month');
        $currentDate = Carbon::now();

        if ($filterType === 'year') {
            $startDate = $currentDate->copy()->startOfYear();
            $previousStartDate = $currentDate->copy()->subYear()->startOfYear();
            $periode = $previousStartDate->year . " - " . $currentDate->year;
        } elseif ($filterType === 'month') {
            $startDate = $currentDate->copy()->startOfMonth();
            $previousStartDate = $currentDate->copy()->subMonth()->startOfMonth();
            $periode = $previousStartDate->translatedFormat('F') . " - " . $currentDate->translatedFormat('F');
        } else {
            $startDate = null;
            $previousStartDate = null;
            $periode = "Seluruh Waktu";
        }

        // Query transaksi berdasarkan filter
        $query = Transaction::query();
        $previousQuery = Transaction::query();

        if ($startDate && $previousStartDate) {
            $query->where('date', '>=', $startDate);
            $previousQuery->where('date', '>=', $previousStartDate);
        }

        // Sampah Dominan (Kategori dengan berat terbesar)
        $currentWaste = $query->select('category_id', DB::raw('SUM(weight) as total_weight'))
            ->groupBy('category_id')
            ->orderByRaw('SUM(weight) DESC')
            ->with('category')
            ->first();

        $previousWaste = $previousQuery->select('category_id', DB::raw('SUM(weight) as total_weight'))
            ->groupBy('category_id')
            ->orderByRaw('SUM(weight) DESC')
            ->with('category')
            ->first();

        // TPS Dominan (TPS dengan transaksi terbanyak)
        $currentTPS = $query->select('landfill_id', DB::raw('COUNT(*) as total_tps'))
            ->groupBy('landfill_id')
            ->orderByRaw('SUM(weight) DESC')
            ->with('landfill')
            ->first();

        $previousTPS = $previousQuery->select('landfill_id', DB::raw('COUNT(*) as total_tps'))
            ->groupBy('landfill_id')
            ->orderByRaw('COUNT(*) DESC')
            ->with('landfill')
            ->first();

        // Kurir Teladan (Kurir dengan pesanan terbanyak)
        $topCourier = $query->select('courier_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('courier_id')
            ->orderByRaw('COUNT(*) DESC')
            ->with('courier')
            ->first();

        $previousTopCourier = $previousQuery->select('courier_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('courier_id')
            ->orderByRaw('COUNT(*) DESC')
            ->with('courier')
            ->first();

        // Hitung pendapatan
        $currentRevenue = $query->sum('price');
        $previousRevenue = $previousQuery->sum('price');

        // Kalkulasi perubahan persentase
        $wasteDifference = ($previousWaste && $previousWaste->total_weight > 0)
            ? (($currentWaste->total_weight - $previousWaste->total_weight) / $previousWaste->total_weight) * 100
            : 0;

        $revenueDifference = ($previousRevenue > 0)
            ? (($currentRevenue - $previousRevenue) / $previousRevenue) * 100
            : 0;

        // Overview Ringkasan
        $overview = "Sampah dominan: " . ($currentWaste->category->name ?? 'Tidak Ada') . 
            " (" . ($currentWaste->total_weight ?? 0) . " kg). " .
            "TPS dominan: " . ($currentTPS->landfill->name ?? 'Tidak Ada') . ". " .
            "Pendapatan: Rp. " . number_format($currentRevenue, 0, ',', '.') . " (" . number_format($revenueDifference, 2) . "%).";

        return view('admin.dashboard', [
            'periode' => $periode,
            'currentWaste' => $currentWaste,
            'previousWaste' => $previousWaste,
            'topCourier' => $topCourier,
            'previousTopCourier' => $previousTopCourier,
            'currentTPS' => $currentTPS,
            'previousTPS' => $previousTPS,
            'currentRevenue' => $currentRevenue,
            'previousRevenue' => $previousRevenue,
            'wasteDifference' => $wasteDifference,
            'revenueDifference' => $revenueDifference,
            'filterType' => $filterType,
            'overview' => $overview
        ]);
    }
}
