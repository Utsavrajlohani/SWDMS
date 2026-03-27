@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($retailer) ? __('Edit Retailer') : __('Add New Retailer') }}
        </h2>
        <a href="{{ route('retailers.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
    <form action="{{ isset($retailer) ? route('retailers.update', $retailer) : route('retailers.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($retailer)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Retailer Business Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $retailer->name ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div>
                <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contact Person Name</label>
                <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person', $retailer->contact_person ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $retailer->phone ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div>
                <label for="area" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Business Area / Region</label>
                <input type="text" name="area" id="area" value="{{ old('area', $retailer->area ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. Civil Lines, Model Town" required>
            </div>

            <div class="md:col-span-2">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address (Optional)</label>
                <input type="email" name="email" id="email" value="{{ old('email', $retailer->email ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="md:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Business Address</label>
                <textarea name="address" id="address" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address', $retailer->address ?? '') }}</textarea>
            </div>
        </div>

        <!-- Credit & BNPL Section -->
        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <span>💳</span> Credit & BNPL Settings
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="bnpl_active" value="1" {{ old('bnpl_active', $retailer->bnpl_active ?? false) ? 'checked' : '' }} class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Enable BNPL / Credit for this Retailer</span>
                    </label>
                </div>

                <div>
                    <label for="credit_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Credit Limit (₹)</label>
                    <input type="number" name="credit_limit" id="credit_limit" step="0.01" value="{{ old('credit_limit', $retailer->credit_limit ?? '0') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="due_date_days" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Due Date Period (Days)</label>
                    <input type="number" name="due_date_days" id="due_date_days" value="{{ old('due_date_days', $retailer->due_date_days ?? '30') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md transform active:scale-95">
                {{ isset($retailer) ? __('Update Retailer Profile') : __('Create Retailer Profile') }}
            </button>
        </div>
    </form>
</div>
@endsection
