@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/50">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Record New Payment</h2>
            <a href="{{ route('payments.index') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm">
                &larr; Back
            </a>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <!-- Retailer -->
                    <div>
                        <label for="retailer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Retailer</label>
                        <select name="retailer_id" id="retailer_id" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" required>
                            <option value="">-- Select Retailer --</option>
                            @foreach ($retailers as $retailer)
                                <option value="{{ $retailer->id }}">
                                    {{ $retailer->name }} (Due: ₹{{ number_format($retailer->current_due, 2) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount_paid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount Paid (₹)</label>
                        <input type="number" step="0.01" name="amount_paid" id="amount_paid" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="0.00" required>
                    </div>

                    <!-- Payment Mode -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Payment Mode</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="group relative flex flex-col items-center justify-center p-3 cursor-pointer rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50 dark:has-[:checked]:bg-indigo-900/40 ghost-active-indigo">
                                <input type="radio" name="payment_mode" value="Cash" class="hidden peer" checked required>
                                <div class="w-4 h-4 border-2 border-gray-300 dark:border-gray-500 rounded-full flex items-center justify-center group-has-[:checked]:border-indigo-600 group-has-[:checked]:bg-indigo-600 mb-1 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100"></div>
                                </div>
                                <span class="text-xl mb-1">💵</span>
                                <span class="text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-tight">Cash</span>
                            </label>

                            <label class="group relative flex flex-col items-center justify-center p-3 cursor-pointer rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-all has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/50 dark:has-[:checked]:bg-emerald-900/40 ghost-active-emerald">
                                <input type="radio" name="payment_mode" value="Online" class="hidden peer" required>
                                <div class="w-4 h-4 border-2 border-gray-300 dark:border-gray-500 rounded-full flex items-center justify-center group-has-[:checked]:border-emerald-600 group-has-[:checked]:bg-emerald-600 mb-1 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100"></div>
                                </div>
                                <span class="text-xl mb-1">📱</span>
                                <span class="text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-tight">Online</span>
                            </label>

                            <label class="group relative flex flex-col items-center justify-center p-3 cursor-pointer rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-all has-[:checked]:border-amber-600 has-[:checked]:bg-amber-50/50 dark:has-[:checked]:bg-amber-900/40 ghost-active-amber">
                                <input type="radio" name="payment_mode" value="Cheque" class="hidden peer" required>
                                <div class="w-4 h-4 border-2 border-gray-300 dark:border-gray-500 rounded-full flex items-center justify-center group-has-[:checked]:border-amber-600 group-has-[:checked]:bg-amber-600 mb-1 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100"></div>
                                </div>
                                <span class="text-xl mb-1">📝</span>
                                <span class="text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-tight">Cheque</span>
                            </label>
                        </div>
                    </div>

                    <!-- Reference Number -->
                    <div>
                        <label for="reference_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reference Number (Optional)</label>
                        <input type="text" name="reference_number" id="reference_number" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="Transaction ID or Cheque No">
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="payment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" value="{{ date('Y-m-d') }}" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" required>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-indigo-500/40 transform active:scale-95 flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Payment Record
                                </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
