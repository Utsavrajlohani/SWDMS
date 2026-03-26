@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($expense) ? __('Edit Expense') : __('Record Expense') }}
        </h2>
        <a href="{{ route('expenses.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
    <form action="{{ isset($expense) ? route('expenses.update', $expense) : route('expenses.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($expense)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expense Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $expense->title ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount (₹)</label>
                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $expense->amount ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date', $expense->date ?? date('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div class="md:col-span-2">
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category" id="category" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="Rent" {{ old('category', $expense->category ?? '') == 'Rent' ? 'selected' : '' }}>Rent</option>
                    <option value="Electricity" {{ old('category', $expense->category ?? '') == 'Electricity' ? 'selected' : '' }}>Electricity</option>
                    <option value="Salaries" {{ old('category', $expense->category ?? '') == 'Salaries' ? 'selected' : '' }}>Salaries</option>
                    <option value="Transport" {{ old('category', $expense->category ?? '') == 'Transport' ? 'selected' : '' }}>Transport</option>
                    <option value="Maintenance" {{ old('category', $expense->category ?? '') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="General" {{ old('category', $expense->category ?? '') == 'General' ? 'selected' : '' }}>General</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $expense->description ?? '') }}</textarea>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-lg transition-all shadow-md transform active:scale-95">
                {{ isset($expense) ? 'Update Expense' : 'Record Expense' }}
            </button>
        </div>
    </form>
</div>
@endsection
