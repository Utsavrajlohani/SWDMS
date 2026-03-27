@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Godown Management') }}
        </h2>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
                <span>🔙</span> Back to Dashboard
            </a>
            <a href="{{ route('warehouses.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors font-medium flex items-center gap-2 shadow-sm">
                <span>➕</span> Add New Godown
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
                    <th class="px-6 py-4">Godown Name</th>
                    <th class="px-6 py-4">Location</th>
                    <th class="px-6 py-4">Created At</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($warehouses as $warehouse)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $warehouse->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $warehouse->location ?? 'Not Specified' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $warehouse->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('warehouses.edit', $warehouse) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                        <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-4xl mb-4">🏘️</div>
                        <p>No godowns found. Click "Add New Godown" to get started.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($warehouses->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
        {{ $warehouses->links() }}
    </div>
    @endif
</div>
@endsection
