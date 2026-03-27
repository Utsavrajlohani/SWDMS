@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-16 pb-24">
    <!-- Animated background orbs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-indigo-400/10 dark:bg-indigo-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-20 -right-40 w-[500px] h-[500px] bg-purple-400/10 dark:bg-purple-600/10 rounded-full blur-3xl animate-pulse" style="animation-delay:1.5s"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Left: Text -->
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-bold text-xs uppercase tracking-widest mb-8 animate-bounce fade-in-up">
                    <span>✨</span> Smart Wholesale System
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-6 leading-tight fade-in-up" style="animation-delay: 0.2s;">
                    Distribute Smarter,<br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-800 dark:from-indigo-400 dark:to-indigo-600 italic">Not Harder.</span>
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-300 max-w-xl mb-10 font-medium leading-relaxed fade-in-up" style="animation-delay: 0.4s;">
                    The ultimate inventory &amp; billing system for modern wholesalers. Automate your operations with GST-compliant invoicing, real-time analytics, and seamless stock tracking.
                </p>
                <div class="flex flex-wrap gap-4 fade-in-up" style="animation-delay: 0.6s;">
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors text-sm font-medium shadow-sm">Get Started</a>


                </div>
            </div>

            <!-- Right: Animated Dashboard SVG Illustration -->
            <div class="hidden md:flex justify-center items-center fade-in-up" style="animation-delay: 0.5s;">
                <div class="relative w-full max-w-md">
                    <!-- Glow behind card -->
                    <div class="absolute inset-0 bg-indigo-500/10 dark:bg-indigo-500/20 blur-3xl rounded-full"></div>
                    <!-- Dashboard card -->
                    <div class="relative bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-zinc-700 p-6 overflow-hidden">
                        <!-- Top bar -->
                        <div class="flex items-center gap-2 mb-5">
                            <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                            <div class="flex-1 ml-2 h-5 bg-slate-100 dark:bg-zinc-800 rounded-lg"></div>
                        </div>
                        <!-- Stat cards row -->
                        <div class="grid grid-cols-3 gap-3 mb-5">
                            <div class="bg-indigo-50 dark:bg-indigo-900/30 rounded-2xl p-3 text-center">
                                <div class="text-xs text-indigo-500 font-bold mb-1">Orders</div>
                                <div class="text-xl font-black text-indigo-700 dark:text-indigo-300 animate-count">248</div>
                            </div>
                            <div class="bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl p-3 text-center">
                                <div class="text-xs text-emerald-500 font-bold mb-1">Revenue</div>
                                <div class="text-xl font-black text-emerald-700 dark:text-emerald-300">₹4.2L</div>
                            </div>
                            <div class="bg-amber-50 dark:bg-amber-900/30 rounded-2xl p-3 text-center">
                                <div class="text-xs text-amber-500 font-bold mb-1">Stock</div>
                                <div class="text-xl font-black text-amber-700 dark:text-amber-300">1.8K</div>
                            </div>
                        </div>
                        <!-- Animated chart bars -->
                        <div class="mb-5">
                            <div class="text-xs font-bold text-slate-500 dark:text-slate-400 mb-3">Weekly Sales</div>
                            <div class="flex items-end gap-2 h-20">
                                <div class="flex-1 bg-indigo-200 dark:bg-indigo-700 rounded-t-lg chart-bar" style="height:45%;animation-delay:0.1s"></div>
                                <div class="flex-1 bg-indigo-300 dark:bg-indigo-600 rounded-t-lg chart-bar" style="height:70%;animation-delay:0.2s"></div>
                                <div class="flex-1 bg-indigo-400 dark:bg-indigo-500 rounded-t-lg chart-bar" style="height:55%;animation-delay:0.3s"></div>
                                <div class="flex-1 bg-indigo-500 dark:bg-indigo-400 rounded-t-lg chart-bar" style="height:90%;animation-delay:0.4s"></div>
                                <div class="flex-1 bg-indigo-400 dark:bg-indigo-500 rounded-t-lg chart-bar" style="height:65%;animation-delay:0.5s"></div>
                                <div class="flex-1 bg-indigo-600 dark:bg-indigo-300 rounded-t-lg chart-bar" style="height:100%;animation-delay:0.6s"></div>
                                <div class="flex-1 bg-indigo-300 dark:bg-indigo-600 rounded-t-lg chart-bar" style="height:75%;animation-delay:0.7s"></div>
                            </div>
                        </div>
                        <!-- Recent items -->
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-zinc-800">
                                <div class="w-7 h-7 bg-blue-100 dark:bg-blue-900/40 rounded-lg flex items-center justify-center text-sm">📦</div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-700 dark:text-slate-200">Basmati Rice 25kg</div>
                                    <div class="text-[10px] text-slate-400">Stock: 142 bags</div>
                                </div>
                                <span class="text-[10px] bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 font-bold px-2 py-0.5 rounded-full">In Stock</span>
                            </div>
                            <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-zinc-800">
                                <div class="w-7 h-7 bg-orange-100 dark:bg-orange-900/40 rounded-lg flex items-center justify-center text-sm">🧾</div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-700 dark:text-slate-200">GST Invoice #1042</div>
                                    <div class="text-[10px] text-slate-400">Raj Traders</div>
                                </div>
                                <span class="text-[10px] bg-amber-100 dark:bg-amber-900/40 text-amber-600 font-bold px-2 py-0.5 rounded-full">₹18,400</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-24 bg-white dark:bg-zinc-900/50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black mb-4">Core Features</h2>
            <p class="text-slate-500 dark:text-slate-300 max-w-2xl mx-auto text-lg">Everything you need to manage wholesale distribution operations efficiently.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:shadow-[0_20px_50px_rgba(59,130,246,0.18)] hover:-translate-y-3 hover:scale-[1.03] transition-all duration-500 cursor-pointer shadow-xl">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-5 shadow-lg shadow-blue-500/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">📦</div>
                <h3 class="font-bold text-xl mb-2 dark:text-white">Inventory Management</h3>
                <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed">Track stock levels in real-time, get low-stock alerts, and manage products with barcode support.</p>
            </div>

            <div class="group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:shadow-[0_20px_50px_rgba(16,185,129,0.18)] hover:-translate-y-3 hover:scale-[1.03] transition-all duration-500 cursor-pointer shadow-xl">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center text-3xl mb-5 shadow-lg shadow-emerald-500/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">🧾</div>
                <h3 class="font-bold text-xl mb-2 dark:text-white">GST Billing</h3>
                <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed">Generate GST-compliant invoices automatically with per-item tax calculation and PDF downloads.</p>
            </div>

            <div class="group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:shadow-[0_20px_50px_rgba(249,115,22,0.18)] hover:-translate-y-3 hover:scale-[1.03] transition-all duration-500 cursor-pointer shadow-xl">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center text-3xl mb-5 shadow-lg shadow-orange-500/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">💳</div>
                <h3 class="font-bold text-xl mb-2 dark:text-white">Credit Tracking</h3>
                <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed">Monitor credit limits, outstanding payments, and customer balances with automatic due tracking.</p>
            </div>

            <div class="group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:shadow-[0_20px_50px_rgba(139,92,246,0.18)] hover:-translate-y-3 hover:scale-[1.03] transition-all duration-500 cursor-pointer shadow-xl">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-3xl mb-5 shadow-lg shadow-purple-500/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">📊</div>
                <h3 class="font-bold text-xl mb-2 dark:text-white">Analytics Dashboard</h3>
                <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed">Visualize sales trends, top products, and demand forecasts with interactive charts and reports.</p>
            </div>
        </div>
    </div>
</section>

<!-- About & Contact Section -->
<section id="about" class="py-24">
<div id="enquiry"></div>
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-16 items-start">
        <div>
            <h2 class="text-4xl font-black mb-6 leading-tight">Why Choose<br><span class="text-indigo-600 dark:text-indigo-400">Smart Wholesale?</span></h2>
            <p class="text-lg text-slate-600 dark:text-slate-300 mb-8">
                SWDMS is designed to simplify the daily operations of wholesale distributors —
                reducing manual work, improving accuracy, and providing clear business insights.
            </p>
            <div class="space-y-4">
                <div class="flex items-center gap-4 p-5 bg-white dark:bg-zinc-900 rounded-2xl border-l-4 border-indigo-500 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/40 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">⚡</div>
                    <div>
                        <div class="font-extrabold text-base text-slate-800 dark:text-white">Automated Operations</div>
                        <div class="text-sm text-slate-500 dark:text-slate-300 mt-0.5">Auto stock deduction, due updates &amp; GST calculations</div>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-5 bg-white dark:bg-zinc-900 rounded-2xl border-l-4 border-emerald-500 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">📋</div>
                    <div>
                        <div class="font-extrabold text-base text-slate-800 dark:text-white">Order Management</div>
                        <div class="text-sm text-slate-500 dark:text-slate-300 mt-0.5">Create, track and manage customer orders seamlessly</div>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-5 bg-white dark:bg-zinc-900 rounded-2xl border-l-4 border-amber-500 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/40 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">💰</div>
                    <div>
                        <div class="font-extrabold text-base text-slate-800 dark:text-white">Payment &amp; Transactions</div>
                        <div class="text-sm text-slate-500 dark:text-slate-300 mt-0.5">Record payments and maintain customer-wise transaction history</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-900 p-10 rounded-[3rem] shadow-2xl border border-slate-200 dark:border-zinc-800">
            <h3 class="text-2xl font-black mb-2 dark:text-white">Request a Demo 🚀</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8 font-medium">Start your digital journey today</p>
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-2xl text-sm font-medium border border-emerald-200 dark:border-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400 rounded-2xl text-sm font-medium border border-rose-200 dark:border-rose-800">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('frontend.enquiry.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}" class="col-span-1 px-5 py-3.5 bg-slate-50 dark:bg-zinc-800 border border-slate-200 dark:border-zinc-700 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none">
                    <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}" class="col-span-1 px-5 py-3.5 bg-slate-50 dark:bg-zinc-800 border border-slate-200 dark:border-zinc-700 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none">
                </div>
                <input type="text" name="phone" placeholder="Phone Number" required value="{{ old('phone') }}" class="w-full px-5 py-3.5 bg-slate-50 dark:bg-zinc-800 border border-slate-200 dark:border-zinc-700 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none">
                <select name="subject" required class="w-full px-5 py-3.5 bg-slate-50 dark:bg-zinc-800 border border-slate-200 dark:border-zinc-700 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                    <option value="">Business Type</option>
                    <option value="Wholesaler" {{ old('subject') == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                    <option value="Distributor" {{ old('subject') == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                <textarea name="message" rows="3" placeholder="Your message..." required class="w-full px-5 py-3.5 bg-slate-50 dark:bg-zinc-800 border border-slate-200 dark:border-zinc-700 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none">{{ old('message') }}</textarea>
                <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 shadow-xl shadow-indigo-500/25 transition-all">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

<style>
    .chart-bar {
        animation: growUp 0.8s ease-out forwards;
        transform-origin: bottom;
        transform: scaleY(0);
    }
    @keyframes growUp { from { transform: scaleY(0); } to { transform: scaleY(1); } }
</style>

<script>

</script>
@endsection
