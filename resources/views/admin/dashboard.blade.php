@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8 px-2">
        <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Admin Dashboard</h1>
    </div>

    <!-- Actions Section (Glassmorphism Table Style) -->
    <div class="bg-white dark:bg-[#111827] rounded-2xl shadow-lg dark:shadow-2xl p-8 border border-gray-100 dark:border-gray-800 mb-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-8 tracking-tight border-b border-gray-100 dark:border-gray-800 pb-4">Actions</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Manage Products -->
            <a href="{{ route('products.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-indigo-900/10 hover:bg-indigo-600 dark:hover:bg-indigo-700 rounded-2xl border border-indigo-100 dark:border-indigo-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10 transition-colors">
                    <span class="text-indigo-700 dark:text-indigo-400 font-bold text-lg group-hover:text-white transition-colors">Manage Products</span>
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/40 rounded-xl flex items-center justify-center group-hover:bg-indigo-500 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Manage Retailers -->
            <a href="{{ route('retailers.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-emerald-900/10 hover:bg-emerald-600 dark:hover:bg-emerald-700 rounded-2xl border border-emerald-100 dark:border-emerald-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-emerald-700 dark:text-emerald-400 font-bold text-lg group-hover:text-white transition-colors">Manage Retailers</span>
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 rounded-xl flex items-center justify-center group-hover:bg-emerald-500 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- View Orders -->
            <a href="{{ route('orders.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-blue-900/10 hover:bg-blue-600 dark:hover:bg-blue-700 rounded-2xl border border-blue-100 dark:border-blue-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-blue-700 dark:text-blue-400 font-bold text-lg group-hover:text-white transition-colors">View Orders</span>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-xl flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Record Payment -->
            <a href="{{ route('payments.create') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-purple-900/10 hover:bg-purple-600 dark:hover:bg-purple-700 rounded-2xl border border-purple-100 dark:border-purple-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-purple-700 dark:text-purple-400 font-bold text-lg group-hover:text-white transition-colors">Record Payment</span>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/40 rounded-xl flex items-center justify-center group-hover:bg-purple-500 transition-colors">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Godown Management -->
            <a href="{{ route('warehouses.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-orange-900/10 hover:bg-orange-600 dark:hover:bg-orange-700 rounded-2xl border border-orange-100 dark:border-orange-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-orange-700 dark:text-orange-400 font-bold text-lg group-hover:text-white transition-colors">Godown Management</span>
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/40 rounded-xl flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- View Reports -->
            <a href="{{ route('admin.reports') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-slate-900/10 hover:bg-slate-600 dark:hover:bg-slate-700 rounded-2xl border border-slate-200 dark:border-slate-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-slate-600 dark:text-slate-400 font-bold text-lg group-hover:text-white transition-colors">View Reports</span>
                    <div class="w-12 h-12 bg-slate-100 dark:bg-slate-900/40 rounded-xl flex items-center justify-center group-hover:bg-slate-500 transition-colors">
                        <svg class="w-6 h-6 text-slate-600 dark:text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Inventory / Stock -->
            <a href="{{ route('inventory.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-teal-900/10 hover:bg-teal-600 dark:hover:bg-teal-700 rounded-2xl border border-teal-100 dark:border-teal-800/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-teal-700 dark:text-teal-400 font-bold text-lg group-hover:text-white transition-colors">Inventory / Stock</span>
                    <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/40 rounded-xl flex items-center justify-center group-hover:bg-teal-500 transition-colors">
                        <svg class="w-6 h-6 text-teal-600 dark:text-teal-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- BNPL Management -->
            <a href="{{ route('retailers.bnpl.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-rose-900/10 hover:bg-rose-600 dark:hover:bg-rose-700 rounded-2xl border border-rose-100 dark:border-rose-800/50 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between relative z-10">
                    <span class="text-rose-700 dark:text-rose-400 font-bold text-lg group-hover:text-white transition-colors">BNPL Management</span>
                    <div class="w-12 h-12 bg-rose-100 dark:bg-rose-900/40 rounded-xl flex items-center justify-center group-hover:bg-rose-500 transition-colors">
                        <svg class="w-6 h-6 text-rose-600 dark:text-rose-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Sales -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex flex-col">
                <span class="text-indigo-100 text-sm font-medium uppercase tracking-wider">Total Sales</span>
                <span class="text-3xl font-bold mt-2">₹{{ number_format($totalSales, 2) }}</span>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex flex-col">
                <span class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Total Customers</span>
                <span class="text-3xl font-bold mt-2">{{ $totalCustomers }}</span>
            </div>
        </div>

        <!-- Pending Dues -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex flex-col">
                <span class="text-amber-100 text-sm font-medium uppercase tracking-wider">Pending Dues</span>
                <span class="text-3xl font-bold mt-2">₹{{ number_format($pendingDues, 2) }}</span>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex flex-col">
                <span class="text-rose-100 text-sm font-medium uppercase tracking-wider">Low Stock Products</span>
                <span class="text-3xl font-bold mt-2">{{ $lowStockProducts }}</span>
            </div>
        </div>
    </div>

    <!-- Charts Section (Full Width now) -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Monthly Sales Overview</h3>
        <div class="relative h-80 w-full">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Products Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Top Selling Products</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 dark:text-gray-400 font-semibold">
                        <tr>
                            <th class="px-6 py-3">Product Name</th>
                            <th class="px-6 py-3 text-right">Units Sold</th>
                            <th class="px-6 py-3 text-right">Current Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($topProducts as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $item->product->name ?? 'Deleted Product' }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    {{ $item->total_sold }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right {{ $item->product->quantity < ($item->product->low_stock_threshold ?? 10) ? 'text-red-500 font-bold' : '' }}">
                                {{ $item->product->quantity }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low Stock Alerts Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-red-100 dark:border-red-900/40">
            <div class="px-6 py-4 border-b border-red-100 dark:border-red-900/40 bg-red-50 dark:bg-red-900/20">
                <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">⚠️ Critical Low Stock Products</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                    <thead class="bg-red-50/50 dark:bg-red-900/10 text-xs uppercase text-gray-500 dark:text-gray-400 font-semibold">
                        <tr>
                            <th class="px-6 py-3">Product Name</th>
                            <th class="px-6 py-3 text-right">Price</th>
                            <th class="px-6 py-3 text-right">Remaining Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($lowStockAlerts as $low_item)
                        <tr class="hover:bg-red-50/30 dark:hover:bg-red-900/10 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $low_item->name }}</td>
                            <td class="px-6 py-4 text-right font-medium">₹{{ number_format($low_item->price, 2) }}</td>
                            <td class="px-6 py-4 text-right text-red-600 font-bold">
                                {{ $low_item->quantity }} <span class="text-xs text-gray-400 block ml-1">(Threshold: {{ $low_item->low_stock_threshold }})</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500 italic">All products are adequately stocked! 🌟</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- AI Demand Forecasting Section (Synchronized Table View) -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border-l-4 border-indigo-500 overflow-hidden mt-6">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-indigo-50/30 dark:bg-indigo-900/10 flex items-center justify-between">
            <h3 class="text-lg font-bold text-indigo-900 dark:text-indigo-300 flex items-center gap-2">
                <span>🤖</span> AI Demand Forecasting (7-Day Projection)
            </h3>
            <span class="text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 px-2 py-1 rounded">BETA</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-[10px] uppercase text-gray-400 font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Product Name</th>
                        <th class="px-6 py-4 text-center">Current Stock</th>
                        <th class="px-6 py-4 text-center">Predicted 7-Day Demand</th>
                        <th class="px-6 py-4 text-right">AI Status Recommendation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($demandForecasts as $forecast)
                    <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-900/10 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-900 dark:text-white uppercase truncate">{{ $forecast->product_name }}</td>
                        <td class="px-6 py-4 text-center font-mono">{{ $forecast->current_stock }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="{{ $forecast->status === 'Stockout Risk' ? 'text-red-500 font-bold' : 'text-indigo-500' }}">
                                {{ $forecast->forecast_7_days }} Units
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($forecast->status === 'Stockout Risk')
                                <span class="px-3 py-1 bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300 rounded-full text-[10px] font-black uppercase shadow-sm border border-red-200 dark:border-red-800">
                                    🔴 Critical Reorder
                                </span>
                            @else
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300 rounded-full text-[10px] font-black uppercase shadow-sm border border-emerald-200 dark:border-emerald-800">
                                    🟢 Healthy Buffer
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                            Not enough sales data to generate AI predictions yet. 📈
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line', 
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Total Sales (₹)',
                data: {!! json_encode($chartValues) !!},
                backgroundColor: 'rgba(99, 102, 241, 0.2)', 
                borderColor: 'rgba(99, 102, 241, 1)', 
                borderWidth: 2,
                tension: 0.4, 
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563'
                    }
                }
            }
        }
    });
</script>
@endsection
