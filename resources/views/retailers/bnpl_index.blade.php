@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('BNPL Management') }}
        </h2>
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to Dashboard
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="px-6 py-6 border-b border-gray-100 dark:border-gray-700 bg-amber-50 dark:bg-amber-900/10 space-y-4">
        <p class="text-sm text-amber-800 dark:text-amber-300 font-medium flex items-center gap-2">
            <span>⏲️</span> Manage credit limits, due dates, and penalties for retailers with Buy Now Pay Later active.
        </p>

        @if(count($availableRetailers) > 0)
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-amber-200 dark:border-amber-800/50">
            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3">➕ Enroll Retailer in BNPL</h3>
            <form action="{{ route('retailers.bnpl.enroll') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                @csrf
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Select Retailer</label>
                    <select name="retailer_id" class="w-full text-sm rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900" required>
                        <option value="">-- Choose --</option>
                        @foreach($availableRetailers as $ar)
                            <option value="{{ $ar->id }}">{{ $ar->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Credit Limit (₹)</label>
                    <input type="number" name="credit_limit" value="50000" class="w-full text-sm rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900" required>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Due Days</label>
                    <input type="number" name="due_date_days" value="30" class="w-full text-sm rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900" required>
                </div>
                <button type="submit" class="w-full py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold rounded-lg shadow-sm transition-all active:scale-95">
                    Enroll Now 🚀
                </button>
            </form>
        </div>
        @endif
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Retailer</th>
                    <th class="px-6 py-4 text-right">Credit Limit</th>
                    <th class="px-6 py-4 text-right">Current Due</th>
                    <th class="px-6 py-4 text-center">Due Days</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($retailers as $retailer)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $retailer->name }}</td>
                    <td class="px-6 py-4 text-right">₹{{ number_format($retailer->credit_limit, 2) }}</td>
                    <td class="px-6 py-4 text-right">
                        <span class="font-bold {{ $retailer->current_due > $retailer->credit_limit ? 'text-red-600' : 'text-emerald-600' }}">
                            ₹{{ number_format($retailer->current_due, 2) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">{{ $retailer->due_date_days }} Days</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('retailers.bnpl', $retailer) }}" class="px-3 py-1 bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white rounded-md transition-colors text-xs font-bold uppercase tracking-wider">
                            Manage BNPL
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <p>No retailers with active BNPL found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
