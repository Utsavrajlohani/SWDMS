<x-guest-layout>
    <!-- Header -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 dark:bg-amber-900/30 rounded-2xl mb-4 shadow-inner">
            <span class="text-3xl">🔑</span>
        </div>
        <h1 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-1">Smart Wholesale Distribution Management System</h1>
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Reset Password</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 font-medium max-w-xs mx-auto">Enter your registered email and we'll send you a reset link instantly.</p>
    </div>

    <!-- Session Status (success message) -->
    @if (session('status'))
        <div class="mb-5 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl flex items-start gap-3">
            <span class="text-xl">✅</span>
            <div>
                <div class="font-bold text-emerald-700 dark:text-emerald-400 text-sm">Reset Link Sent!</div>
                <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-0.5">{{ session('status') }}</div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" id="fp-form" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email Address</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input id="email"
                    class="block w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-400/30 focus:border-indigo-500 focus:shadow-[0_0_0_4px_rgba(99,102,241,0.15)] dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400 {{ $errors->has('email') ? 'border-rose-400' : '' }}"
                    type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="pt-1">
            <button type="submit" id="fp-btn"
                class="w-full flex justify-center items-center gap-2 py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-500/25 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] hover:shadow-[0_8px_30px_rgba(99,102,241,0.5)] active:scale-95">
                <svg id="fp-spinner" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span id="fp-btn-text">📧 Send Reset Link</span>
            </button>
        </div>

        <!-- Back to login -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                ← Back to Sign In
            </a>
        </div>
    </form>

    <script>
        document.getElementById('fp-form').addEventListener('submit', function() {
            const btn     = document.getElementById('fp-btn');
            const spinner = document.getElementById('fp-spinner');
            const text    = document.getElementById('fp-btn-text');
            spinner.classList.remove('hidden');
            text.textContent = 'Sending…';
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');
        });
    </script>
</x-guest-layout>
