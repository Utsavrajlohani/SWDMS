@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($warehouse) ? __('Edit Godown') : __('Add New Godown') }}
        </h2>
        <a href="{{ route('warehouses.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
    <form action="{{ isset($warehouse) ? route('warehouses.update', $warehouse) : route('warehouses.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($warehouse)) @method('PUT') @endif

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Godown Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $warehouse->name ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location / Address</label>
            <textarea name="location" id="location" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('location', $warehouse->location ?? '') }}</textarea>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md transform active:scale-95">
                {{ isset($warehouse) ? 'Update Godown' : 'Create Godown' }}
            </button>
        </div>
    </form>
</div>
@endsection
