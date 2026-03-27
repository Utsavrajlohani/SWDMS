@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Retailers') }}
        </h2>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
                <span>🔙</span> Back to Dashboard
            </a>
            <a href="{{ route('retailers.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors font-medium flex items-center gap-2 shadow-sm">
                <span>➕</span> Add New Retailer
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <!-- Search & Filter Bar -->
    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
        <form action="{{ route('retailers.index') }}" method="GET" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[300px] relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, area or contact person..." 
                    class="w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            </div>
            <div class="w-48 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">📍</span>
                <input type="text" name="area" value="{{ request('area') }}" placeholder="Filter by Area..." 
                    class="w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            </div>
            <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors font-bold text-sm shadow-md">
                Filter
            </button>
            @if(request()->has('search') || request()->has('area'))
                <a href="{{ route('retailers.index') }}" class="text-sm text-gray-500 hover:text-gray-700 underline font-medium">Clear All</a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Retailer Name</th>
                    <th class="px-6 py-4">Area / Region</th>
                    <th class="px-6 py-4">Contact</th>
                    <th class="px-6 py-4">Phone</th>
                    <th class="px-6 py-4">Current Due</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($retailers as $retailer)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $retailer->name }}</div>
                        <div class="text-xs text-gray-400">{{ $retailer->referral_code }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                            📍 {{ $retailer->area ?? 'General' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $retailer->contact_person ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $retailer->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-gray-900 dark:text-white">₹{{ number_format($retailer->current_due, 2) }}</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('retailers.ledger', $retailer) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Ledger</a>
                        <a href="{{ route('retailers.edit', $retailer) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-4xl mb-4">👥</div>
                        <p>No retailers found. Click "Add New Retailer" to get started.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($retailers->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
        {{ $retailers->links() }}
    </div>
    @endif
</div>
@endsection
