@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory Management') }}
        </h2>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
                <span>🔙</span> Back to Dashboard
            </a>
            <a href="{{ route('inventory.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors font-medium flex items-center gap-2 shadow-sm">
                <span>🔄</span> Sync/Transfer Stock
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
                    <th class="px-6 py-4">Product Name</th>
                    <th class="px-6 py-4">Godown</th>
                    <th class="px-6 py-4 text-center">Current Stock</th>
                    <th class="px-6 py-4">Last Updated</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($inventory as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $item->warehouse->name }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 rounded-full text-xs font-bold {{ $item->quantity < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $item->quantity }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $item->updated_at->diffForHumans() }}</td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('inventory.store') }}" method="POST" class="inline-flex items-center gap-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                            <input type="hidden" name="warehouse_id" value="{{ $item->warehouse_id }}">
                            <input type="number" name="quantity" class="w-20 text-xs rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900" placeholder="+/-">
                            <button type="submit" class="p-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors" title="Update Stock">
                                ✅
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-4xl mb-4">📋</div>
                        <p>Inventory is empty. Sync stock to see godown-wise details.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inventory->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
        {{ $inventory->links() }}
    </div>
    @endif
</div>
@endsection
