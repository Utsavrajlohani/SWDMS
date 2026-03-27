@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment History') }}
        </h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
            <a class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold text-sm transition-all shadow-md flex items-center gap-2" href="{{ route('payments.create') }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Record New Payment
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    <!-- Payments Summary Cards -->
    @if($payments->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-2">
        @foreach($payments->groupBy('retailer_id') as $retailerId => $retailerPayments)
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
            <h3 class="font-bold text-gray-800 dark:text-gray-200 truncate flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                {{ $retailerPayments->first()->retailer->name ?? 'N/A' }}
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Paid: <span class="font-bold text-green-600 dark:text-green-400">₹{{ number_format($retailerPayments->sum('amount_paid'), 2) }}</span></p>
            <div class="flex items-center justify-between mt-2">
                <span class="text-[10px] bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 px-2 py-0.5 rounded-full font-bold">{{ $retailerPayments->count() }} transaction(s)</span>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="flex items-center justify-between mb-2 mt-4">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Transaction History</h3>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 dark:text-gray-400 font-semibold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Retailer</th>
                        <th class="px-6 py-4 text-right">Amount Paid</th>
                        <th class="px-6 py-4">Mode</th>
                        <th class="px-6 py-4">Ref No</th>
                        <th class="px-6 py-4 text-right">Payment Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($payments as $payment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-gray-400">#{{ $payment->id }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $payment->retailer->name ?? 'N/A' }}</div>
                            <div class="text-[10px] text-gray-400">Recorded: {{ $payment->created_at->format('d M, H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-green-600 dark:text-green-400">₹{{ number_format($payment->amount_paid, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-400 capitalize">
                                {{ $payment->payment_mode }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-mono text-xs">{{ $payment->reference_number ?? '-' }}</td>
                        <td class="px-6 py-4 text-right text-gray-500">{{ $payment->payment_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
