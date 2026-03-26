@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Product Details: {{ $product->name }}
        </h2>
        <div class="flex gap-2">
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm">
                &larr; Back to List
            </a>
            <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-sm font-medium">
                Edit Product
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Stats -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 tracking-widest">SKU Code</label>
                        <p class="text-xl font-mono dark:text-white mt-1">{{ $product->sku }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 tracking-widest">Pricing</label>
                        <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">₹{{ number_format($product->price, 2) }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 tracking-widest">GST Rate</label>
                        <p class="text-xl font-bold text-indigo-600 mt-1">{{ $product->gst_percent }}%</p>
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 tracking-widest">Low Stock Alert</label>
                        <p class="text-xl font-bold text-rose-500 mt-1">{{ $product->low_stock_threshold }} Units</p>
                    </div>
                </div>
            </div>

            <!-- Description/Meta -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Product Audit Log</h3>
                <div class="text-sm text-gray-500 space-y-2">
                    <p>Created: {{ $product->created_at->format('d M Y, h:i A') }}</p>
                    <p>Last Updated: {{ $product->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar: Stock Status -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 text-center">
                <div class="w-16 h-16 bg-indigo-50 dark:bg-indigo-900/30 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                    📦
                </div>
                <h3 class="text-gray-500 text-sm font-bold uppercase tracking-widest mb-1">Total Available Stock</h3>
                <p class="text-4xl font-black text-gray-900 dark:text-white">{{ $product->quantity }}</p>
                <div class="mt-4">
                    @if($product->quantity <= $product->low_stock_threshold)
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold uppercase">Restock Required</span>
                    @else
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase">In Stock</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
