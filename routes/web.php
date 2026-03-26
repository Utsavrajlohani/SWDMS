<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;



Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');
    Route::post('/enquiry', [\App\Http\Controllers\FrontendController::class, 'submitEnquiry'])->name('frontend.enquiry.submit');
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';

// Emergency Logout Route (GET)
Route::get('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout.get');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/settings/business', [\App\Http\Controllers\BusinessSettingsController::class, 'edit'])->name('settings.business');
    Route::post('/settings/business', [\App\Http\Controllers\BusinessSettingsController::class, 'update'])->name('settings.business.update');
    
    Route::get('/retailers/bnpl-management', [\App\Http\Controllers\RetailerController::class, 'bnplIndex'])->name('retailers.bnpl.index');
    Route::post('/retailers/bnpl-enroll', [\App\Http\Controllers\RetailerController::class, 'enrollBnpl'])->name('retailers.bnpl.enroll');
    Route::get('/retailers/{retailer}/ledger', [\App\Http\Controllers\RetailerController::class, 'ledger'])->name('retailers.ledger');
    Route::get('/retailers/{retailer}/bnpl', [\App\Http\Controllers\RetailerController::class, 'bnpl'])->name('retailers.bnpl');
    Route::put('/retailers/{retailer}/bnpl', [\App\Http\Controllers\RetailerController::class, 'updateBnpl'])->name('retailers.bnpl.update');

    Route::resource('retailers', \App\Http\Controllers\RetailerController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('/users/{user}/toggle-bnpl', [\App\Http\Controllers\UserController::class, 'toggleBnpl'])->name('users.toggle-bnpl');
    
    Route::resource('warehouses', \App\Http\Controllers\WarehouseController::class);
    Route::resource('expenses', \App\Http\Controllers\ExpenseController::class);
    Route::get('/daily-closings', [\App\Http\Controllers\DailyClosingController::class, 'index'])->name('daily_closings.index');
    Route::get('/daily-closings/create', [\App\Http\Controllers\DailyClosingController::class, 'create'])->name('daily_closings.create');
    Route::post('/daily-closings', [\App\Http\Controllers\DailyClosingController::class, 'store'])->name('daily_closings.store');
    
    Route::get('/admin/enquiries', [\App\Http\Controllers\Admin\EnquiryController::class, 'index'])->name('admin.enquiries.index');
    Route::get('/admin/enquiries/{enquiry}', [\App\Http\Controllers\Admin\EnquiryController::class, 'show'])->name('admin.enquiries.show');
    Route::delete('/admin/enquiries/{enquiry}', [\App\Http\Controllers\Admin\EnquiryController::class, 'destroy'])->name('admin.enquiries.destroy');
    
    Route::get('/payments/create', [\App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create'); 
    Route::post('/payments', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store'); 
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    
    Route::get('/api/products/{product}/recommendations', function(\App\Models\Product $product) {
        return response()->json($product->frequentlyBoughtTogether());
    })->name('api.products.recommendations');
});

// Shared Routes (Protected by Auth)
Route::middleware(['auth'])->group(function () {
    // Orders
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::get('orders/{order}/download', [\App\Http\Controllers\OrderController::class, 'downloadInvoice'])->name('orders.download');
    
    // Products
    Route::get('/products/export/csv', [\App\Http\Controllers\ProductController::class, 'export'])->name('products.export');
    Route::get('/products/export/catalog', [\App\Http\Controllers\ProductController::class, 'downloadCatalog'])->name('products.catalog');
    Route::get('/products/export/barcodes', [\App\Http\Controllers\ProductController::class, 'downloadBarcodes'])->name('products.barcodes');
    Route::get('/inventory/aging', [\App\Http\Controllers\ProductController::class, 'agingReport'])->name('products.aging');
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('inventory', \App\Http\Controllers\InventoryController::class)->only(['index', 'create', 'store']);

    // Payments
    Route::get('/payments', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');

    // Profile Routes
    Route::get('/settings', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('settings.index');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});


Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
