<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-2xl mb-4 shadow-inner">
            <span class="text-3xl">🚀</span>
        </div>
        <h1 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-1">Smart Wholesale Distribution Management System</h1>
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Create Account</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 font-medium">Join SWDMS today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Full Name</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="name" class="block w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400" 
                       type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email Address</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input id="email" class="block w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400" 
                       type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" class="block w-full pl-11 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-400/30 focus:border-indigo-500 dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400" 
                       type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters" oninput="checkPasswordStrength(this.value)" />
                <button type="button" onclick="togglePw('password','eyeIcon1')" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-indigo-500 transition-colors" tabindex="-1">
                    <svg id="eyeIcon1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Min. 8 characters with <span class="font-semibold">Uppercase, Lowercase, Number &amp; Symbol</span> for <span class="text-emerald-500 font-bold">Strong</span> password.</p>
            
            <!-- Password Strength Indicator -->
            <div class="mt-2 space-y-1.5">
                <div class="flex gap-1 h-1">
                    <div id="strength-bar-1" class="h-full w-1/3 rounded-full bg-gray-200 dark:bg-gray-700 transition-all duration-300"></div>
                    <div id="strength-bar-2" class="h-full w-1/3 rounded-full bg-gray-200 dark:bg-gray-700 transition-all duration-300"></div>
                    <div id="strength-bar-3" class="h-full w-1/3 rounded-full bg-gray-200 dark:bg-gray-700 transition-all duration-300"></div>
                </div>
                <p id="password-strength-text" class="text-xs font-bold text-gray-500 uppercase tracking-wider">Strength: <span id="strength-label" class="text-gray-400">Enter password</span></p>
            </div>
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Confirm Password</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input id="password_confirmation" class="block w-full pl-11 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-indigo-400/30 focus:border-indigo-500 focus:shadow-[0_0_0_4px_rgba(99,102,241,0.15)] dark:bg-gray-700/50 dark:text-white text-sm transition-all duration-200 outline-none placeholder:text-gray-400" 
                       type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password" oninput="checkPasswordMatch()" />
                <button type="button" onclick="togglePw('password_confirmation','eyeIcon2')" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-indigo-500 transition-colors" tabindex="-1">
                    <svg id="eyeIcon2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <p id="password-match-text" class="mt-1.5 text-xs font-semibold hidden"></p>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-500/25 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] hover:shadow-[0_8px_30px_rgba(99,102,241,0.5)] active:scale-95">
                🚀 {{ __('Create Account') }}
            </button>
        </div>

        <div class="text-center mt-6">
             <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                 Already have an account? 
                 <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Sign in here</a>
             </p>
        </div>
    </form>

    <script>
        function togglePw(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon  = document.getElementById(iconId);
            const isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }

        function checkPasswordStrength(password) {
            const bar1  = document.getElementById('strength-bar-1');
            const bar2  = document.getElementById('strength-bar-2');
            const bar3  = document.getElementById('strength-bar-3');
            const label = document.getElementById('strength-label');

            // Weak: <8 chars or missing all criteria
            // Medium: 8+ chars with some (UC or num or symbol)
            // Strong: 8+ chars with UC + LC + number + symbol
            let strength;
            const hasUpper  = /[A-Z]/.test(password);
            const hasLower  = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSymbol = /[^A-Za-z0-9]/.test(password);
            const criteria  = [hasUpper, hasLower, hasNumber, hasSymbol].filter(Boolean).length;

            if (password.length < 8 || criteria < 2) {
                strength = 1; // Weak
            } else if (password.length >= 8 && hasUpper && hasLower && hasNumber && hasSymbol) {
                strength = 3; // Strong
            } else {
                strength = 2; // Medium
            }

            // Reset bars with inline styles (avoids Tailwind CDN dynamic class issue)
            [bar1, bar2, bar3].forEach(b => {
                b.style.background = '#e5e7eb';
                b.style.boxShadow  = 'none';
            });

            if (password.length === 0) {
                label.textContent  = 'Enter password';
                label.style.color  = '#9ca3af';
                label.style.fontWeight = '500';
            } else if (strength <= 1) {
                bar1.style.background = '#f43f5e';
                bar1.style.boxShadow  = '0 0 6px rgba(244,63,94,0.5)';
                label.textContent     = 'Weak 💀';
                label.style.color     = '#f43f5e';
                label.style.fontWeight = '900';
            } else if (strength === 2) {
                [bar1, bar2].forEach(b => {
                    b.style.background = '#fbbf24';
                    b.style.boxShadow  = '0 0 6px rgba(251,191,36,0.5)';
                });
                label.textContent     = 'Medium ⚡';
                label.style.color     = '#fbbf24';
                label.style.fontWeight = '900';
            } else {
                [bar1, bar2, bar3].forEach(b => {
                    b.style.background = '#10b981';
                    b.style.boxShadow  = '0 0 6px rgba(16,185,129,0.5)';
                });
                label.textContent     = 'Strong 🔥';
                label.style.color     = '#10b981';
                label.style.fontWeight = '900';
            }
            checkPasswordMatch();
        }

        function checkPasswordMatch() {
            const pw  = document.getElementById('password').value;
            const cpw = document.getElementById('password_confirmation').value;
            const msg = document.getElementById('password-match-text');
            if (!cpw) { msg.classList.add('hidden'); return; }
            msg.classList.remove('hidden');
            if (pw === cpw) {
                msg.textContent  = '✔️ Passwords match';
                msg.style.color  = '#10b981';
            } else {
                msg.textContent  = '❌ Passwords do not match';
                msg.style.color  = '#f43f5e';
            }
        }
    </script>
</x-guest-layout>
