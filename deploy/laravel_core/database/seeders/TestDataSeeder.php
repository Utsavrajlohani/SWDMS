<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Retailer;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Retailer record (standalone)
        if (!Retailer::where('email', 'retailer@swdms.com')->exists()) {
            Retailer::create([
                'name' => 'Test Retailer Store',
                'email' => 'retailer@swdms.com',
                'phone' => '9876543210',
                'address' => '123 Retailer St',
                'credit_limit' => 50000,
                'current_due' => 0,
            ]);
        }

        // Create Products
        $products = [
            ['name' => 'Basmati Rice 25kg', 'price' => 1200, 'quantity' => 100, 'low_stock_threshold' => 10, 'gst_percent' => 5],
            ['name' => 'Refined Oil 5L', 'price' => 650, 'quantity' => 50, 'low_stock_threshold' => 5, 'gst_percent' => 12],
            ['name' => 'Wheat Flour 10kg', 'price' => 450, 'quantity' => 200, 'low_stock_threshold' => 20, 'gst_percent' => 0],
            ['name' => 'Sugar 50kg', 'price' => 2200, 'quantity' => 30, 'low_stock_threshold' => 5, 'gst_percent' => 5],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['name' => $p['name']], $p);
        }
    }
}
