@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/50">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Add New Customer</h2>
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm">
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

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Customer Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="Company or Individual Name" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address (Login ID)</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="email@example.com" required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="10-digit number">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                        <input type="password" name="password" id="password" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" required>
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" required>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Billing Address</label>
                        <textarea name="address" id="address" rows="3" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" placeholder="Full street address">{{ old('address') }}</textarea>
                    </div>

                    <!-- Credit Limit -->
                    <div class="md:col-span-2">
                        <label for="credit_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Credit Limit (₹)</label>
                        <input type="number" step="0.01" name="credit_limit" id="credit_limit" value="{{ old('credit_limit', 100000) }}" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" required>
                        <p class="mt-1 text-xs text-gray-500 italic">Default credit limit for new B2B accounts.</p>
                    </div>

                    <!-- BNPL Status -->
                    <div class="md:col-span-2">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="bnpl_active" value="1" {{ old('bnpl_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Enable Buy Now Pay Later (BNPL) for this customer</span>
                        </label>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all transform hover:-translate-y-0.5">
                        Create Customer Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
