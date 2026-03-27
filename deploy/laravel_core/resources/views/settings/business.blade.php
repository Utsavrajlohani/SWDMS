@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
            <span>⚙️</span> Account & Business Settings
        </h2>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-emerald-700 dark:text-emerald-300 animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.business.update') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-8">
        @csrf
        
        <!-- Personal Profile Section -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="p-1 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 rounded">👤</span> Personal Profile
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Personal Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
            </div>
        </div>

        <hr class="border-gray-100 dark:border-gray-700">

        <!-- Business Profile Section -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="p-1 bg-red-100 dark:bg-red-900/40 text-red-600 rounded">🏢</span> Business Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Business Name</label>
                <input type="text" name="business_name" value="{{ old('business_name', $user->business_name) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all" placeholder="e.g. Swastik Wholesale">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">GSTIN Number</label>
                <input type="text" name="gstin" value="{{ old('gstin', $user->gstin) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all" placeholder="Optional">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Business Email</label>
                <input type="email" name="business_email" value="{{ old('business_email', $user->business_email) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Business Phone</label>
                <input type="text" name="business_phone" value="{{ old('business_phone', $user->business_phone) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all">
            </div>

            <div class="col-span-full space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Business Address</label>
                <textarea name="business_address" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-red-500 focus:border-red-500 transition-all">{{ old('business_address', $user->business_address) }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-red-500/20 active:scale-95">
                Save Profile 🦾
            </button>
        </div>
    </form>
</div>
@endsection
