@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm font-medium shadow-sm flex items-center gap-2">
                <span>&larr;</span> Back
            </a>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                🔒 {{ __('Security Settings') }}
            </h2>
        </div>
    </div>

    @if(session('status') === 'password-updated')
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
            <span class="text-xl">✅</span>
            <span class="font-medium">{{ __('Password updated successfully.') }}</span>
        </div>
    @endif

    <div class="max-w-2xl mx-auto">
        <!-- Change Password -->
        <div id="change-password" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ __('Update Password') }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Current Password') }}</label>
                        <input id="current_password" type="password" name="current_password" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5 @error('current_password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('current_password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('New Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 py-2.5">
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3">
                        <button type="submit" class="px-6 py-2.5 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 hover:bg-gray-700 focus:bg-gray-700 dark:hover:bg-white font-semibold rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                            {{ __('Update Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
f

        </div>
    </div>
</div>
@endsection
