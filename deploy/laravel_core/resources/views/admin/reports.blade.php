@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            📊 {{ __('Reports Hub') }}
        </h2>
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm">
            &larr; Back to Dashboard
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Inventory Aging Report -->
            <a href="{{ route('products.aging') }}" class="group flex flex-col items-center justify-center p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl hover:bg-slate-600 dark:hover:bg-slate-700 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-slate-500 transition-colors">
                    <svg class="w-8 h-8 text-slate-600 dark:text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-white text-center">Inventory Aging</span>
                <span class="text-xs text-slate-500 dark:text-slate-400 mt-2 text-center group-hover:text-slate-200">View slow-moving & stagnant stock</span>
            </a>

            <!-- Export Inventory CSV -->
            <a href="{{ route('products.export') }}" class="group flex flex-col items-center justify-center p-6 bg-white dark:bg-green-900/10 border border-green-200 dark:border-green-800/50 rounded-2xl hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/40 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-green-500 transition-colors">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="font-bold text-green-800 dark:text-green-200 group-hover:text-white text-center">Export Inventory</span>
                <span class="text-xs text-green-500 dark:text-green-400 mt-2 text-center group-hover:text-green-200">Download stock data as CSV Excel</span>
            </a>

            <!-- Catalog PDF -->
            <a href="{{ route('products.catalog') }}" class="group flex flex-col items-center justify-center p-6 bg-white dark:bg-rose-900/10 border border-rose-200 dark:border-rose-800/50 rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-700 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="w-16 h-16 bg-rose-100 dark:bg-rose-900/40 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-rose-500 transition-colors">
                    <svg class="w-8 h-8 text-rose-600 dark:text-rose-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="font-bold text-rose-800 dark:text-rose-200 group-hover:text-white text-center">Generate Catalog</span>
                <span class="text-xs text-rose-500 dark:text-rose-400 mt-2 text-center group-hover:text-rose-200">Download B2B product catalog PDF</span>
            </a>

            <!-- Print Barcodes -->
            <a href="{{ route('products.barcodes') }}" class="group flex flex-col items-center justify-center p-6 bg-white dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/50 rounded-2xl hover:bg-amber-600 dark:hover:bg-amber-700 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900/40 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-amber-500 transition-colors">
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <span class="font-bold text-amber-800 dark:text-amber-200 group-hover:text-white text-center">Print Barcodes</span>
                <span class="text-xs text-amber-500 dark:text-amber-400 mt-2 text-center group-hover:text-amber-200">A4 printable barcode label sheets</span>
            </a>

        </div>
    </div>
</div>
@endsection
