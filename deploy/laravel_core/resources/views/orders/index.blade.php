@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders Management') }}
        </h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
            <a class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold text-sm transition-all shadow-md flex items-center gap-2" href="{{ route('orders.create') }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Order
            </a>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <form action="{{ route('orders.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="Search by Order ID or Customer Name..." value="{{ request('search') }}">
            <button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold text-sm transition-all shadow-md flex items-center gap-2" type="submit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition ease-in-out duration-150 flex items-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 dark:text-gray-400 font-semibold">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Total Amount</th>
                        <th class="px-6 py-4 text-center">Payment</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($orders as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs">#{{ $order->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $order->user->name ?? 'Unknown Customer' }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">₹{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-[10px] font-bold uppercase px-2 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-600">
                                {{ $order->payment_method == 'pay_now' ? 'Immediate' : 'BNPL' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClass = match($order->status) {
                                    'approved', 'delivered', 'completed', 'Paid' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400',
                                    'Suspicious' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400',
                                    default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-400',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right flex items-center justify-end gap-3">
                            @if($order->status === 'approved')
                                <form action="{{ route('orders.update', $order->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="delivered">
                                    <button type="submit" class="text-orange-600 hover:text-orange-900 font-bold text-xs uppercase bg-orange-50 hover:bg-orange-100 px-2 py-1 rounded border border-orange-200 transition-colors" title="Mark as Delivered">
                                        Deliver
                                    </button>
                                </form>
                            @endif
                            <a class="text-indigo-600 hover:text-indigo-900 font-medium whitespace-nowrap" href="{{ route('orders.show',$order->id) }}">Order</a>
                            <a class="text-emerald-600 hover:text-emerald-900 font-medium whitespace-nowrap" href="{{ route('orders.download',$order->id) }}" title="Download GST Invoice">PDF</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
