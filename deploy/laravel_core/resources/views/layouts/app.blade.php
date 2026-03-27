<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
        @include('layouts.styles')
        <!-- Dark Mode Init: apply saved theme before paint to avoid flash -->
        <script>
            (function() {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header) || View::hasSection('header'))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @if(View::hasSection('header'))
                            @yield('header')
                        @else
                            {{ $header }}
                        @endif
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <!-- Support for Blade Components -->
                {{ $slot ?? '' }}

                <!-- Support for Legacy Blade Inheritance -->
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>

        <script>
            function toggleTheme() {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.theme = isDark ? 'dark' : 'light';
                updateThemeIcons(isDark);
            }

            function updateThemeIcons(isDark) {
                // Desktop icons
                const sun  = document.getElementById('icon-sun');
                const moon = document.getElementById('icon-moon');
                if (sun && moon) {
                    sun.classList.toggle('hidden', !isDark);
                    moon.classList.toggle('hidden', isDark);
                }
                // Mobile icons
                const sunM  = document.getElementById('icon-sun-mobile');
                const moonM = document.getElementById('icon-moon-mobile');
                const label = document.getElementById('theme-label-mobile');
                if (sunM && moonM) {
                    sunM.classList.toggle('hidden', !isDark);
                    moonM.classList.toggle('hidden', isDark);
                }
                if (label) label.textContent = isDark ? 'Light Mode' : 'Dark Mode';
            }

            // Set correct icon on load
            document.addEventListener('DOMContentLoaded', function() {
                updateThemeIcons(document.documentElement.classList.contains('dark'));
            });
        </script>
    </body>
</html>
