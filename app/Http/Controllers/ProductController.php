<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductController extends Controller
{
    /**
     * Download products as CSV (Bulk Export).
     */
    public function export()
    {
        $products = Product::all();
        $fileName = 'Inventory_Export_' . date('Y_m_d') . '.csv';
        $tempPath = storage_path('app/' . $fileName);
        
        $file = fopen($tempPath, 'w');
        fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM
        fputcsv($file, ['ID', 'Name', 'SKU', 'Price (₹)', 'Quantity', 'GST %', 'Low Stock Alert Threshold']);
        foreach ($products as $row) {
            fputcsv($file, [$row->id, $row->name, $row->sku, $row->price, $row->quantity, $row->gst_percent, $row->low_stock_threshold]);
        }
        fclose($file);

        return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $products = $query->latest()->paginate(10);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required',
            'sku'                 => 'nullable|unique:products,sku',
            'price'               => 'required|numeric',
            'gst_percent'         => 'required|numeric',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'batch_no'            => 'nullable|string',
            'expiry_date'         => 'nullable|date',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                        ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'                => 'required',
            'sku'                 => 'nullable|unique:products,sku,' . $product->id,
            'price'               => 'required|numeric',
            'gst_percent'         => 'required|numeric',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'batch_no'            => 'nullable|string',
            'expiry_date'         => 'nullable|date',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success', 'Product updated successfully');
    }

    public function agingReport()
    {
        $products = Product::with(['orderItems' => function($q) {
            $q->latest()->limit(1);
        }])->get()->map(function($product) {
            $lastOrder = $product->orderItems->first();
            $product->days_since_last_sale = $lastOrder 
                ? (int) abs(now()->startOfDay()->diffInDays($lastOrder->created_at->startOfDay())) 
                : (int) abs(now()->startOfDay()->diffInDays($product->created_at->startOfDay()));
            return $product;
        })->sortByDesc('days_since_last_sale');

        return view('products.aging_report', compact('products'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Product deleted successfully');
    }

    public function downloadBarcodes(Request $request)
    {
        $products = Product::where('quantity', '>', 0)->get();
        $generator = new BarcodeGeneratorHTML();
        
        $pdf = Pdf::loadView('products.barcodes_pdf', compact('products', 'generator'));
        $fileName = 'Barcode_Batch_' . now()->format('Y_m_d') . '.pdf';
        $tempPath = storage_path('app/public/' . $fileName);
        $pdf->save($tempPath);
        return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);
    }
    /**
     * Generate and download PDF product catalog.
     */
    public function downloadCatalog()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('products.pdf_catalog', compact('products'));
        $fileName = 'Product_Catalog_' . date('Y_m_d') . '.pdf';
        $tempPath = storage_path('app/public/' . $fileName);
        $pdf->save($tempPath);
        return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);
    }
}
