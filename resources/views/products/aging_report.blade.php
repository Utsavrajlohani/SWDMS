@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Inventory Aging Report</h2>
            <p class="text-sm text-gray-500">Identifying slow-moving and stagnant stock for optimization.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Current Stock</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Inventory Value</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aging (Days)</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900 dark:text-white">{{ $product->name }}</div>
                        <div class="text-xs text-gray-400">SKU: {{ $product->sku }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $product->quantity }}</td>
                    <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-300">₹{{ number_format($product->price * $product->quantity, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="font-mono font-bold">{{ $product->days_since_last_sale }} Days</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($product->days_since_last_sale > 60)
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-[10px] uppercase font-black">Stagnant</span>
                        @elseif($product->days_since_last_sale > 30)
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] uppercase font-black">Slow Moving</span>
                        @else
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] uppercase font-black">Healthy</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
