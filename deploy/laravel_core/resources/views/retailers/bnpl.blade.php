@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('BNPL Settings') }}: {{ $retailer->name }}
        </h2>
        <a href="{{ route('retailers.bnpl.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-8 py-4 bg-amber-50 dark:bg-amber-900/20 border-b border-amber-100 dark:border-amber-800">
            <h3 class="text-amber-800 dark:text-amber-300 font-bold uppercase tracking-wider text-sm">Credit Control Configuration</h3>
        </div>
        
        <form action="{{ route('retailers.bnpl.update', $retailer) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status -->
                <div class="md:col-span-2">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="bnpl_active" value="1" class="sr-only peer" {{ $retailer->bnpl_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Enable Buy Now Pay Later (BNPL)</span>
                    </label>
                </div>

                <!-- Limits -->
                <div>
                    <label for="credit_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Credit Limit (₹)</label>
                    <input type="number" step="0.01" name="credit_limit" id="credit_limit" value="{{ old('credit_limit', $retailer->credit_limit) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="due_date_days" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Due Date Period (Days)</label>
                    <input type="number" name="due_date_days" id="due_date_days" value="{{ old('due_date_days', $retailer->due_date_days) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="penalty_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Late Penalty Rate (%)</label>
                    <input type="number" step="0.01" name="penalty_rate" id="penalty_rate" value="{{ old('penalty_rate', $retailer->penalty_rate) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <p class="mt-1 text-xs text-gray-500 italic">Percentage charged per month after due date.</p>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 dark:border-gray-700">
                <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md transform active:scale-95 flex items-center justify-center gap-2">
                    <span>💾</span> Save BNPL Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
