<?php

namespace App\Http\Controllers;

use App\Models\DailyClosing;
use App\Models\Order;
use App\Models\Expense;
use Illuminate\Http\Request;

class DailyClosingController extends Controller
{
    public function index()
    {
        $closings = DailyClosing::latest()->paginate(10);
        return view('daily_closings.index', compact('closings'));
    }

    public function create()
    {
        // Try to fetch today's stats automatically
        $today = now()->format('Y-m-d');
        $salesTotal = Order::whereDate('created_at', $today)->sum('total_amount');
        $expenseTotal = Expense::whereDate('date', $today)->sum('amount');
        
        // Use yesterday's closing as today's opening
        $yesterday = now()->subDay()->format('Y-m-d');
        $yesterdayClosing = DailyClosing::where('date', $yesterday)->first();
        $openingBalance = $yesterdayClosing ? $yesterdayClosing->closing_balance : 0;

        return view('daily_closings.create', compact('openingBalance', 'salesTotal', 'expenseTotal', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:daily_closings',
            'opening_balance' => 'required|numeric',
            'closing_balance' => 'required|numeric',
            'sales_total' => 'required|numeric',
            'expense_total' => 'required|numeric',
        ]);

        DailyClosing::create($request->all());

        return redirect()->route('daily_closings.index')->with('success', 'Daily closing recorded successfully.');
    }
}
