@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daily Closings') }}
        </h2>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
                <span>🔙</span> Back to Dashboard
            </a>
            <a href="{{ route('daily_closings.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors font-medium flex items-center gap-2 shadow-sm">
                <span>🔒</span> Perform Day Closing
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4 text-right">Opening</th>
                    <th class="px-6 py-4 text-right">Sales</th>
                    <th class="px-6 py-4 text-right">Expenses</th>
                    <th class="px-6 py-4 text-right">Closing</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($closings as $closing)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($closing->date)->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">₹{{ number_format($closing->opening_balance, 2) }}</td>
                    <td class="px-6 py-4 text-right text-emerald-600 font-medium">+₹{{ number_format($closing->sales_total, 2) }}</td>
                    <td class="px-6 py-4 text-right text-rose-600 font-medium">-₹{{ number_format($closing->expense_total, 2) }}</td>
                    <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white">₹{{ number_format($closing->closing_balance, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-4xl mb-4">📅</div>
                        <p>No daily closings recorded yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($closings->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
        {{ $closings->links() }}
    </div>
    @endif
</div>
@endsection
