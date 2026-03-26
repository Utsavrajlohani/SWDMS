<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'SWDMS - Smart Wholesale Distribution Management System')</title>
    <meta name="description" content="@yield('meta_description', 'Smart inventory & billing system for wholesalers. Automating wholesale operations with GST invoicing and real-time analytics.')">
    <meta property="og:title" content="Smart Wholesale Distribution Management System">
    <meta property="og:description" content="An integrated system for managing wholesale distribution operations efficiently.">
    <meta property="og:type" content="website">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                    colors: { primary: '#6366f1', secondary: '#0f172a' }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .dark .glass { background: rgba(0, 0, 0, 0.7); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
        
        .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        .hover-glow:hover { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4); }
        .bg-gradient-indigo { background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); }
    </style>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-black text-slate-900 dark:text-white font-sans transition-colors duration-300">
    <nav id="main-nav" class="sticky top-0 z-50 glass border-b border-slate-200 dark:border-zinc-800 transition-shadow duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-lg shadow-indigo-500/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">🚀</div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black tracking-tighter text-indigo-600 dark:text-indigo-400 leading-none">SWDMS</span>
                        <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-slate-500 dark:text-slate-400 leading-none mt-1">Smart Wholesale System</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8 font-medium">
                    <a href="{{ route('home') }}" class="nav-link relative py-1 hover:text-primary transition-colors" data-section="hero">Home</a>
                    <a href="#features" class="nav-link relative py-1 hover:text-primary transition-colors" data-section="features">Features</a>
                    <a href="#about" class="nav-link relative py-1 hover:text-primary transition-colors" data-section="about">About</a>
                    <a href="#enquiry" class="nav-link relative py-1 hover:text-primary transition-colors" data-section="enquiry">Contact</a>
                    <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light'" title="Toggle Light / Dark Mode" aria-label="Toggle Light / Dark Mode" class="p-2 rounded-full hover:bg-slate-200 dark:hover:bg-zinc-800 relative group">
                        🌓
                        <span class="pointer-events-none absolute -bottom-8 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-lg bg-zinc-800 text-white dark:bg-slate-100 dark:text-zinc-800 text-[10px] font-semibold px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 shadow-lg z-50">Light / Dark</span>
                    </button>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 shadow-lg shadow-indigo-500/20 transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 bg-indigo-600 dark:bg-indigo-800 text-white rounded-full hover:scale-105 hover:bg-indigo-700 dark:hover:bg-indigo-900 shadow-lg shadow-indigo-500/20 dark:shadow-indigo-500/20 transition-all font-bold">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <style>
        .nav-link.active { color: #ed1c24; }
        .nav-link.active::after { content: ''; position: absolute; bottom: -2px; left: 0; right: 0; height: 2px; background: #ed1c24; border-radius: 999px; }
    </style>

    <main>
        @yield('content')
    </main>

    <footer class="bg-secondary text-white dark:bg-black border-t border-zinc-800">
        <!-- Gradient accent line -->
        <div class="h-0.5 w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-primary"></div>
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-xl shadow-lg shadow-red-500/20">🚀</div>
                        <div class="flex flex-col">
                            <span class="text-xl font-black tracking-tighter text-primary leading-none">SWDMS</span>
                            <span class="text-[8px] uppercase font-bold tracking-[0.2em] text-slate-300 leading-none mt-1">Smart Wholesale System</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        The ultimate solution for managing wholesale distribution operations efficiently with automation and real-time insights.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4">Quick Links</h4>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#about" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="#enquiry" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Features -->
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4">Features</h4>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li>📦 Inventory Management</li>
                        <li>🧾 GST Billing</li>
                        <li>💳 Credit Tracking</li>
                        <li>📊 Sales Analytics</li>
                    </ul>
                </div>

                <!-- Connect -->
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4">Connect</h4>
                    <div class="flex gap-3 mb-4">
                        <a href="#" class="w-10 h-10 bg-zinc-800 hover:bg-zinc-700 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-zinc-800 hover:bg-zinc-700 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-zinc-800 hover:bg-zinc-700 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                    <p class="text-sm text-slate-300">
                        <a href="{{ route('login') }}" class="hover:text-white transition-colors">Admin Login →</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-slate-400">
                <p>&copy; {{ date('Y') }} Smart Wholesale Distribution Management System. All rights reserved.</p>
                <p class="mt-2 md:mt-0">Built with Laravel & Tailwind CSS</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(a.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Scroll spy for active nav highlight
        const sections = ['features', 'about', 'enquiry'];
        const navLinks = document.querySelectorAll('.nav-link');
        
        function updateActive() {
            let current = 'hero';
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el && window.scrollY >= el.offsetTop - 100) current = id;
            });
            navLinks.forEach(link => {
                link.classList.toggle('active', link.dataset.section === current);
            });
        }
        window.addEventListener('scroll', updateActive);
        updateActive();

        // Navbar scroll shadow
        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('shadow-xl', window.scrollY > 10);
            nav.classList.toggle('shadow-black/20', window.scrollY > 10);
        });
    </script>
</body>
</html>
