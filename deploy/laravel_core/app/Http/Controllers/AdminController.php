<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Retailer;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index()
    {
        $totalSales = Order::sum('total_amount');
        $totalRetailers = Retailer::count();
        $pendingDues = Retailer::sum('current_due');
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'low_stock_threshold')->count();
        $lowStockAlerts = Product::whereColumn('quantity', '<=', 'low_stock_threshold')->take(5)->get();

        // Prepare data for chart (Last 6 months)
        $salesData = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->limit(6)
            ->get();

        $chartLabels = $salesData->pluck('month')->map(function($m) {
            return \Carbon\Carbon::parse($m)->format('M Y');
        });
        $chartValues = $salesData->pluck('total');

        $topProducts = \App\Models\OrderItem::select('product_id', \Illuminate\Support\Facades\DB::raw('sum(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->limit(5)
            ->get();

        // AI Demand Forecasting (7-day trailing average)
        $demandForecasts = \App\Models\OrderItem::select('product_id', \Illuminate\Support\Facades\DB::raw('sum(quantity) as recent_sold'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('product_id')
            ->orderByDesc('recent_sold')
            ->with('product')
            ->limit(5)
            ->get()
            ->map(function($item) {
                if (!$item->product) return null;
                $dailyAvg = max(0, $item->recent_sold / 7);
                $forecast7Days = ceil($dailyAvg * 7);
                $status = ($item->product->quantity - $forecast7Days < 0) ? 'Stockout Risk' : 'Healthy';
                return (object)[
                    'product_name' => $item->product->name,
                    'current_stock' => $item->product->quantity,
                    'forecast_7_days' => $forecast7Days,
                    'status' => $status
                ];
            })->filter();

        $totalCustomers = $totalRetailers;
        $stats = compact('totalSales', 'totalCustomers', 'totalRetailers', 'pendingDues', 'lowStockProducts', 'chartLabels', 'chartValues', 'topProducts', 'demandForecasts', 'lowStockAlerts');

        return view('admin.dashboard', $stats);
    }

    public function reports()
    {
        return view('admin.reports');
    }
}
