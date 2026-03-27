<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ config('app.description', 'Login or explore the SWDMS portal.') }}">

        <title>{{ config('app.name', 'SWDMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Figtree', 'sans-serif'],
                        },
                    },
                },
            }
        </script>
        
        <!-- Dark Mode Logic -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
        @include('layouts.styles')
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 dark:from-gray-950 dark:via-indigo-950 dark:to-gray-900 p-4 relative overflow-hidden">
            <!-- Decorative orbs -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-pink-400/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 mb-6 z-10">
                <x-application-logo class="w-20 h-20 fill-current text-indigo-600 dark:text-indigo-400" />
                <span class="text-3xl font-black text-white drop-shadow-md tracking-tight">{{ config('app.name', 'SWDMS') }}</span>
            </a>

            <!-- Form Card -->
            <div class="relative z-10 w-full max-w-2xl bg-white/95 dark:bg-gray-800/95 backdrop-blur-md shadow-2xl rounded-3xl px-10 py-10 border border-white/30">
                {{ $slot }}
            </div>

            <div class="mt-6 text-white/60 text-xs z-10">
                &copy; {{ date('Y') }} SWDMS &middot; Smart Wholesale Distribution System
            </div>
        </div>
    </body>
</html>
