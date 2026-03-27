@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/50">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Create New Order</h2>
            <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm font-medium shadow-sm">
                &larr; Back
            </a>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf

                <!-- Retailer Selection -->
                <div class="mb-8">
                    @if(auth()->user()->role === 'admin')
                        <label for="retailer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Retailer</label>
                        <select name="retailer_id" id="retailer_id" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2.5" required>
                            <option value="">-- Select Retailer --</option>
                            @foreach ($retailers as $retailer)
                                <option value="{{ $retailer->id }}">
                                    {{ $retailer->name }} (Due: ₹{{ number_format($retailer->current_due, 2) }}, Limit: ₹{{ number_format($retailer->credit_limit, 2) }})
                                </option>
                            @endforeach
                        </select>
                    @else
                        <!-- Retailer Context (for Retailer Portal) -->
                        @php $retailer = auth()->user()->retailerProfile; @endphp
                        <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800 rounded-lg p-4 flex items-center gap-3">
                            <span class="text-2xl">🏪</span>
                            <div>
                                <h3 class="font-semibold text-indigo-900 dark:text-indigo-300">Placing B2B Order for: {{ $retailer->name ?? auth()->user()->name }}</h3>
                                <p class="text-sm text-indigo-700 dark:text-indigo-400">
                                    Current Due: <span class="font-bold">₹{{ number_format($retailer->current_due ?? 0, 2) }}</span> &bull; 
                                    Credit Limit: <span class="font-bold">₹{{ number_format($retailer->credit_limit ?? 0, 2) }}</span>
                                </p>
                            </div>
                        </div>
                        <input type="hidden" name="retailer_id" value="{{ $retailer->id ?? '' }}">
                    @endif
                </div>

                <!-- Products Table -->
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3 flex items-center gap-2">
                    📦 Select Products
                </h3>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden mb-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="productTable">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-5/12">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price (₹)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-24">Qty</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4">
                                    <select name="products[0][id]" class="product-select block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 dark:bg-gray-700 dark:text-white" onchange="updateProductDetails(this)" required>
                                        <option value="">Select Product...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->quantity }}">
                                                {{ $product->name }} (Stock: {{ $product->quantity }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" class="price-input block w-full rounded-md border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 sm:text-sm py-2" readonly>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" class="stock-input block w-full rounded-md border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 sm:text-sm py-2" readonly>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" name="products[0][quantity]" class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 dark:bg-gray-700 dark:text-white" min="1" value="1" required>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" class="text-gray-400 dark:text-gray-600 cursor-not-allowed remove-row" disabled>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Payment Method Selection -->
                <div class="mb-8 bg-gray-50 dark:bg-gray-900/30 p-4 rounded-xl border border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        💳 Payment Method
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="group relative flex items-center p-4 cursor-pointer rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-800 transition-all select-none has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50 dark:has-[:checked]:bg-indigo-900/40 ghost-active-indigo">
                            <input type="radio" name="payment_method" value="bnpl" class="hidden peer" checked required>
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-500 rounded-full flex items-center justify-center group-has-[:checked]:border-indigo-600 group-has-[:checked]:bg-indigo-600 transition-all">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></div>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">BNPL (Buy Now Pay Later)</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Add to retailer's credit balance</p>
                                </div>
                            </div>
                        </label>

                        <label class="group relative flex items-center p-4 cursor-pointer rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-800 transition-all select-none has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/50 dark:has-[:checked]:bg-emerald-900/40 ghost-active-emerald">
                            <input type="radio" name="payment_method" value="pay_now" class="hidden peer" required>
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-500 rounded-full flex items-center justify-center group-has-[:checked]:border-emerald-600 group-has-[:checked]:bg-emerald-600 transition-all">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></div>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">Immediate Payment</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mark as Delivered and Paid</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Status Selection (only for BNPL) -->
                    <div id="statusContainer" class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700/50">
                        <label for="order_status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                             📌 Order Status
                        </label>
                        <select name="status" id="order_status" class="block w-full sm:w-64 rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:bg-gray-700 dark:text-white sm:text-sm py-2">
                            <option value="delivered">Delivered (Completed)</option>
                            <option value="approved" selected>Approved (Pending Delivery)</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500" id="statusHelp">Immediate Payment is always marked as 'Delivered'.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="button" onclick="addProductRow()" class="mt-4 px-4 py-2 bg-white dark:bg-gray-800 border-2 border-indigo-100 dark:border-indigo-900/30 hover:border-indigo-600 dark:hover:border-indigo-500 text-indigo-600 dark:text-indigo-400 rounded-xl transition-all text-sm font-bold flex items-center gap-2 group shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Another Product
                    </button>

                    <button type="submit" class="w-full sm:w-auto px-12 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span>🚀</span> Place B2B Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let productIndex = 1;
    const productsJson = @json($products);

    function updateProductDetails(select) {
        var selectedOption = select.options[select.selectedIndex];
        var row = select.closest('tr');
        row.querySelector('.price-input').value = selectedOption.getAttribute('data-price') || '';
        row.querySelector('.stock-input').value = selectedOption.getAttribute('data-stock') || '';

        // Auto Merge Logic
        var productId = select.value;
        if(productId) {
            var allSelects = document.querySelectorAll('.product-select');
            for(var i=0; i<allSelects.length; i++) {
                if(allSelects[i] !== select && allSelects[i].value === productId) {
                    var otherRow = allSelects[i].closest('tr');
                    var qtyInput = otherRow.querySelector('input[type="number"]');
                    qtyInput.value = parseInt(qtyInput.value || 0) + 1;
                    
                    alert('Product already selected! Quantity increased.');
                    if(document.querySelectorAll('#productTable tbody tr').length > 1) {
                        row.remove();
                    } else {
                        select.value = "";
                        row.querySelector('.price-input').value = '';
                        row.querySelector('.stock-input').value = '';
                    }
                    return;
                }
            }
        }
    }

    document.getElementById('addRow').addEventListener('click', function() {
        const table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        const rowId = productIndex++;

        newRow.innerHTML = `
            <td class="px-6 py-4">
                <select name="products[${rowId}][id]" class="product-select block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 dark:bg-gray-700 dark:text-white" onchange="updateProductDetails(this)" required>
                    <option value="">Select Product...</option>
                    ${productsJson.map(p => `
                        <option value="${p.id}" data-price="${p.price}" data-stock="${p.quantity}">
                            ${p.name} (Stock: ${p.quantity})
                        </option>
                    `).join('')}
                </select>
            </td>
            <td class="px-6 py-4">
                <input type="text" class="price-input block w-full rounded-md border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 sm:text-sm py-2" readonly>
            </td>
            <td class="px-6 py-4">
                <input type="text" class="stock-input block w-full rounded-md border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 sm:text-sm py-2" readonly>
            </td>
            <td class="px-6 py-4">
                <input type="number" name="products[${rowId}][quantity]" class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 dark:bg-gray-700 dark:text-white" min="1" value="1" required>
            </td>
            <td class="px-6 py-4 text-right">
                <button type="button" class="text-red-600 hover:text-red-900 remove-row" onclick="removeRow(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </td>
        `;
    });

    function removeRow(btn) {
        if(document.querySelectorAll('#productTable tbody tr').length > 1) {
            btn.closest('tr').remove();
        }
    }

    // Status Toggle Logic
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const statusSelect = document.getElementById('order_status');
            const statusHelp = document.getElementById('statusHelp');
            if(this.value === 'pay_now') {
                statusSelect.value = 'delivered';
                statusSelect.disabled = true;
                statusHelp.textContent = "Immediate Payment is always marked as 'Delivered'.";
            } else {
                statusSelect.disabled = false;
                statusHelp.textContent = "Choose if the order is already delivered or just approved.";
            }
        });
    });

    // Initial trigger
    window.addEventListener('DOMContentLoaded', () => {
        const checked = document.querySelector('input[name="payment_method"]:checked');
        if(checked) checked.dispatchEvent(new Event('change'));
    });
</script>
@endsection
