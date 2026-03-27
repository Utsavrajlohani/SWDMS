<style type="text/tailwindcss">
    @layer components {
        .btn { 
            @apply inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-semibold text-xs uppercase tracking-widest transition-all duration-200 shadow-sm active:scale-95; 
        }
        .btn-primary { 
            @apply bg-indigo-600 text-white hover:bg-indigo-700 hover:shadow-indigo-500/40 hover:shadow-lg focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2; 
        }
        .btn-secondary { 
            @apply bg-gray-500 text-white hover:bg-gray-600 hover:shadow-gray-400/40 hover:shadow-lg focus:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2; 
        }
        .btn-success { 
            @apply bg-emerald-600 text-white hover:bg-emerald-700 hover:shadow-emerald-500/40 hover:shadow-lg focus:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2; 
        }
        .btn-danger { 
            @apply bg-red-600 text-white hover:bg-red-700 hover:shadow-red-500/40 hover:shadow-lg focus:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2; 
        }
        .btn-info {
            @apply bg-sky-500 text-white hover:bg-sky-600 hover:shadow-sky-400/40 hover:shadow-lg focus:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2;
        }

        .form-control { 
            @apply block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm; 
        }
        .form-select { 
            @apply block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm; 
        }

        .alert { @apply p-4 mb-4 rounded-xl border border-transparent shadow-sm transition-all duration-300; }
        .alert-success { @apply bg-emerald-50 border-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:border-emerald-800 dark:text-emerald-400; }
        .alert-danger { @apply bg-rose-50 border-rose-100 text-rose-800 dark:bg-rose-900/20 dark:border-rose-800 dark:text-rose-400; }
        .alert-warning { @apply bg-amber-50 border-amber-100 text-amber-800 dark:bg-amber-900/20 dark:border-amber-800 dark:text-amber-400; }
        .alert-info { @apply bg-sky-50 border-sky-100 text-sky-800 dark:bg-sky-900/20 dark:border-sky-800 dark:text-sky-400; }

        .row { @apply flex flex-wrap -mx-4; }
        .form-group { @apply mb-4; }
    }
</style>
