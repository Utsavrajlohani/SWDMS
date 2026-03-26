@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left w-full">
            {{ __('Global Application Settings') }}
        </h2>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
        <form action="{{ route('settings.update') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- App Identity -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-indigo-600 dark:text-indigo-400 border-b border-gray-100 dark:border-gray-700 pb-2">Business Identity</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Application Name</label>
                        <input type="text" name="app_name" value="{{ $settings['app_name'] ?? '' }}" 
                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Support Email</label>
                        <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}" 
                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5">
                    </div>
                </div>

                <!-- Financial Systems -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-red-600 dark:text-red-400 border-b border-gray-100 dark:border-gray-700 pb-2">Financials & Taxes</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Standard GST Rate (%)</label>
                        <div class="relative">
                            <input type="number" name="gst_rate" value="{{ $settings['gst_rate'] ?? '18' }}" 
                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5 pr-10">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 font-bold">%</div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Currency Symbol</label>
                        <input type="text" name="currency_symbol" value="{{ $settings['currency_symbol'] ?? '₹' }}" 
                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 transition-all shadow-xl shadow-indigo-500/25">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
