<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-2xl mb-4 shadow-inner">
            <span class="text-3xl">🚀</span>
        </div>
        <h1 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-1">Smart Wholesale Distribution Management System</h1>
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Welcome Back</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 font-medium">Sign in to continue to your dashboard</p>
    </div>

    <!-- Auth Error Banner -->
    @if ($errors->any())
        <div class="mb-5 p-4 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 rounded-2xl flex items-start gap-3">
            <span class="text-xl mt-0.5">❌</span>
            <div>
                <div class="font-bold text-rose-700 dark:text-rose-400 text-sm">Login Failed</div>
                <div class="text-xs text-rose-600 dark:text-rose-400 mt-0.5">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5" id="login-form">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email Address</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email"
                    class="block w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-400/30 focus:border-indigo-500 focus:shadow-[0_0_0_4px_rgba(99,102,241,0.15)] dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400 {{ $errors->has('email') ? 'border-rose-400 focus:ring-rose-300/30 focus:border-rose-500' : '' }}"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password"
                    class="block w-full pl-11 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-400/30 focus:border-indigo-500 focus:shadow-[0_0_0_4px_rgba(99,102,241,0.15)] dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <button type="button" onclick="toggleLoginPw()" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-indigo-500 transition-colors" tabindex="-1">
                    <svg id="loginEyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Remember Me + Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 cursor-pointer transition-all"
                    name="remember">
                <span class="ml-2 text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-gray-300 transition-colors">
                    Remember me
                    <span class="text-xs text-indigo-400 ml-1">(30 days)</span>
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold transition-colors hover:underline" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-1">
            <button type="submit" id="login-btn"
                class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-500/25 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] hover:shadow-[0_8px_30px_rgba(99,102,241,0.5)] active:scale-95">
                <svg id="btn-spinner" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span id="btn-text">🔐 Sign In</span>
            </button>
        </div>

    </form>

    <script>
        function toggleLoginPw() {
            const field = document.getElementById('password');
            const icon  = document.getElementById('loginEyeIcon');
            const isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }

        document.getElementById('login-form').addEventListener('submit', function() {
            const btn     = document.getElementById('login-btn');
            const spinner = document.getElementById('btn-spinner');
            const text    = document.getElementById('btn-text');
            spinner.classList.remove('hidden');
            text.textContent = 'Signing in…';
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');
        });
    </script>
</x-guest-layout>
