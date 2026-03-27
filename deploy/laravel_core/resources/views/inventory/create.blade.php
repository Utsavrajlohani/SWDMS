@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Godown Stock') }}
        </h2>
        <a href="{{ route('inventory.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
    <div class="mb-6 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-100 dark:border-indigo-800">
        <p class="text-sm text-indigo-800 dark:text-indigo-300">
            <strong>Note:</strong> Select a product and a godown to set its current physical stock level.
        </p>
    </div>
    
    <form action="{{ route('inventory.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Product</label>
            <select name="product_id" id="product_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">-- Choose Product --</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (SKU: {{ $product->sku ?? 'N/A' }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="warehouse_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Godown</label>
            <select name="warehouse_id" id="warehouse_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Quantity (Physical Count)</label>
            <input type="number" name="quantity" id="quantity" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required min="0">
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md transform active:scale-95 flex items-center justify-center gap-2">
                <span>🔄</span> Update Stock Level
            </button>
        </div>
    </form>
</div>
@endsection
