<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @forelse($products as $product)
    <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-slate-100 dark:border-zinc-800 overflow-hidden hover:shadow-xl transition">
        <div class="h-48 bg-slate-100 dark:bg-zinc-800 relative">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=random&size=512" class="w-full h-full object-cover">
            <div class="absolute top-4 left-4">
                <span class="px-2 py-1 bg-primary text-white text-[10px] font-bold rounded uppercase tracking-tighter">In Stock</span>
            </div>
        </div>
        <div class="p-6">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">{{ $product->category ?? 'General' }}</p>
            <h3 class="font-bold text-lg mb-1 leading-tight">{{ $product->name }}</h3>
            <div class="text-primary font-black text-xl mb-4">₹{{ number_format($product->price, 2) }}</div>
            <a href="#enquiry" class="block w-full text-center py-2.5 border-2 border-secondary dark:border-slate-700 rounded-xl text-xs font-black hover:bg-secondary hover:text-white dark:hover:bg-white dark:hover:text-black transition">
                Enquire for Bulk
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full py-32 text-center">
        <div class="text-6xl mb-4">🔦</div>
        <h3 class="text-2xl font-bold mb-2">No products found</h3>
        <p class="text-slate-500">Try searching with a different term or keyword.</p>
    </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $products->links() }}
</div>
