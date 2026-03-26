<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        .grid { width: 100%; border-collapse: collapse; }
        .barcode-card { 
            width: 30%; 
            display: inline-block; 
            padding: 15px; 
            border: 1px dotted #ccc; 
            text-align: center; 
            margin: 5px;
            vertical-align: top;
        }
        .name { font-size: 10px; font-weight: bold; margin-bottom: 5px; height: 25px; overflow: hidden; }
        .sku { font-size: 9px; color: #666; margin-top: 5px; }
        .price { font-size: 11px; font-weight: bold; margin-top: 2px; }
    </style>
</head>
<body>
    <h3 style="text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px;">STOCK BARCODE BATCH ({{ now()->format('d-M-Y') }})</h3>
    
    <div style="margin-top: 20px;">
        @foreach($products as $product)
            @if($product->sku)
            <div class="barcode-card">
                <div class="name">{{ $product->name }}</div>
                <div>
                   {!! $generator->getBarcode($product->sku, $generator::TYPE_CODE_128, 1.5, 30) !!}
                </div>
                <div class="sku">{{ $product->sku }}</div>
                <div class="price">MRP: ₹{{ number_format($product->price, 2) }}</div>
            </div>
            @endif
        @endforeach
    </div>
</body>
</html>
