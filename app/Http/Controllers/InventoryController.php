<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::with(['product', 'warehouse'])->latest()->paginate(15);
        return view('inventory.index', compact('inventory'));
    }

    public function create()
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
        return view('inventory.create', compact('products', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:0',
        ]);

        // Update or Create inventory for that product in that warehouse
        $inventory = Inventory::updateOrCreate(
            ['product_id' => $request->product_id, 'warehouse_id' => $request->warehouse_id],
            ['quantity' => $request->quantity]
        );

        // Sync with Product total quantity
        $totalStock = Inventory::where('product_id', $request->product_id)->sum('quantity');
        Product::where('id', $request->product_id)->update(['quantity' => $totalStock]);
        
        return redirect()->route('inventory.index')->with('success', 'Stock updated successfully in godown and synchronized with product total.');
    }
}
