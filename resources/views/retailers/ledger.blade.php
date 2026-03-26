@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Retailer Ledger') }}: {{ $retailer->name }}
        </h2>
        <div class="flex items-center gap-3">
            <a href="{{ route('retailers.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
                <span>🔙</span> Back to Retailers
            </a>
            <a href="{{ route('retailers.ledger', [$retailer, 'download' => 1]) }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors font-medium flex items-center gap-2 shadow-sm">
                <span>📄</span> Download PDF
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors font-medium flex items-center gap-2 shadow-sm">
                <span>🖨️</span> Print Statement
            </button>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <span class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Billed</span>
            <div class="text-2xl font-bold text-gray-900 dark:text-white mt-1">₹{{ number_format($retailer->total_billed, 2) }}</div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <span class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Paid</span>
            <div class="text-2xl font-bold text-emerald-600 mt-1">₹{{ number_format($retailer->total_paid, 2) }}</div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-indigo-100 dark:border-indigo-900 shadow-indigo-500/5">
            <span class="text-sm text-indigo-500 uppercase font-bold tracking-wider">Outstanding Due</span>
            <div class="text-2xl font-bold text-rose-600 mt-1">₹{{ number_format($retailer->current_due, 2) }}</div>
        </div>
    </div>

    <!-- Ledger Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-gray-200">Transaction History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Transaction</th>
                        <th class="px-6 py-4 text-right">Debit (+)</th>
                        <th class="px-6 py-4 text-right">Credit (-)</th>
                        <th class="px-6 py-4 text-right">Running Balance</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @php $runningBalance = 0; @endphp
                    @foreach($orders->merge($retailer->payments)->sortBy('created_at') as $item)
                    @php 
                        $isOrder = isset($item->total_amount);
                        $debit = $isOrder ? $item->total_amount : 0;
                        $credit = !$isOrder ? $item->amount_paid : 0;
                        $runningBalance += ($debit - $credit);
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-gray-500">{{ $item->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $isOrder ? "Order #{$item->id}" : "Payment Recv" }}
                        </td>
                        <td class="px-6 py-4 text-right text-rose-600">{{ $debit > 0 ? '₹'.number_format($debit, 2) : '-' }}</td>
                        <td class="px-6 py-4 text-right text-emerald-600">{{ $credit > 0 ? '₹'.number_format($credit, 2) : '-' }}</td>
                        <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white">₹{{ number_format($runningBalance, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
