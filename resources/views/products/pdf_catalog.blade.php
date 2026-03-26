<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { bg-color: #f8f9fa; font-weight: bold; }
        .barcode { margin-top: 5px; }
        .barcode div { width: 1px !important; } /* Fix for HTML renderer on some PDF engines */
        .price { font-weight: bold; color: #2d3748; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }} - Product Catalog</h1>
        <p>Generated on: {{ date('F d, Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>SKU & Barcode</th>
                <th>Price</th>
                <th>Stock Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>
                    <strong>{{ $product->sku }}</strong><br>
                    <div class="barcode">
                        {!! $product->getBarcodeHtml() !!}
                    </div>
                </td>
                <td class="price">₹{{ number_format($product->price, 2) }}</td>
                <td>
                    @if($product->quantity > $product->low_stock_threshold)
                        In Stock ({{ $product->quantity }})
                    @else
                        <span style="color: red;">Low Stock ({{ $product->quantity }})</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
