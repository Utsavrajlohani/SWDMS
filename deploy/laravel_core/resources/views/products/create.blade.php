@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/50">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Add New Product</h2>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm">
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

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product Name</label>
                        <input type="text" name="name" id="name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="e.g. Premium Rice" required>
                    </div>

                    <!-- SKU -->
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SKU / Code</label>
                        <input type="text" name="sku" id="sku" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="e.g. RIC-001">
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (₹)</label>
                        <input type="number" step="0.01" name="price" id="price" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="0.00" required>
                    </div>


                    <!-- Low Stock Threshold -->
                    <div>
                        <label for="low_stock_threshold" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Low Stock Alert at</label>
                        <input type="number" name="low_stock_threshold" id="low_stock_threshold" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="10" value="10">
                    </div>

                    <!-- Batch Number -->
                    <div>
                        <label for="batch_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Batch Number</label>
                        <input type="text" name="batch_no" id="batch_no" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="e.g. B-001">
                    </div>

                    <!-- Expiry Date -->
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5">
                    </div>

                    <!-- GST -->
                    <div>
                        <label for="gst_percent" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">GST Percentage (%)</label>
                        <select name="gst_percent" id="gst_percent" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5">
                            <option value="0">0% — Exempt</option>
                            <option value="5">5% — Essential Goods</option>
                            <option value="18" selected>18% — Standard Rate</option>
                            <option value="28">28% — Luxury / Demerit Goods</option>
                        </select>
                    </div>




                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all transform hover:-translate-y-0.5">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
