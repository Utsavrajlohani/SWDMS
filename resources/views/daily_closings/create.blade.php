@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perform Day Closing') }}
        </h2>
        <a href="{{ route('daily_closings.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="bg-indigo-600 px-8 py-4">
        <h3 class="text-white font-bold text-lg">Daily Reconciliation: {{ \Carbon\Carbon::parse($today)->format('l, M d, Y') }}</h3>
    </div>
    <form action="{{ route('daily_closings.store') }}" method="POST" class="p-8 space-y-6">
        @csrf
        <input type="hidden" name="date" value="{{ $today }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Balances -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-gray-400">Balances</h4>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Opening Balance (Legacy)</label>
                    <input type="number" name="opening_balance" value="{{ $openingBalance }}" class="w-full rounded-lg border-gray-300 dark:bg-gray-900 shadow-sm" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Closing Balance (Actual Cash/Bank)</label>
                    <input type="number" step="0.01" name="closing_balance" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>
            </div>

            <!-- Totals -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-gray-400">System Totals (Today)</h4>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Total Sales Recorded</label>
                    <input type="number" name="sales_total" value="{{ $salesTotal }}" class="w-full rounded-lg border-gray-300 dark:bg-gray-900 shadow-sm text-emerald-600 font-bold" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Total Expenses Recorded</label>
                    <input type="number" name="expense_total" value="{{ $expenseTotal }}" class="w-full rounded-lg border-gray-300 dark:bg-gray-900 shadow-sm text-rose-600 font-bold" readonly>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
            <p class="text-sm text-blue-800 dark:text-blue-300 italic text-center">
                Check all physical cash and bank statements before closing the day. This action cannot be undone for the current date.
            </p>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md transform active:scale-95 flex items-center justify-center gap-2">
                <span>🔒</span> Finalize and Close Day
            </button>
        </div>
    </form>
</div>
@endsection
