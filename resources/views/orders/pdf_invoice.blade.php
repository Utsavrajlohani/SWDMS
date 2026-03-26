<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; }
        .invoice-box { padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, .15); }
        .header { border-bottom: 2px solid #ed1c24; padding-bottom: 20px; margin-bottom: 20px; }
        .header table { width: 100%; }
        .company-name { font-size: 24px; font-weight: bold; color: #ed1c24; }
        .info-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .info-table td { vertical-align: top; padding: 5px; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .items-table th { background: #f8f9fa; border: 1px solid #dee2e6; padding: 10px; text-align: left; }
        .items-table td { border: 1px solid #dee2e6; padding: 10px; }
        .totals-table { width: 40%; float: right; margin-top: 20px; }
        .totals-table td { padding: 5px; text-align: right; }
        .gst-summary { clear: both; margin-top: 40px; font-size: 10px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #777; padding: 10px 0; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <div class="company-name">{{ $order->user->business_name ?? 'SMART WHOLESALE' }}</div>
                        <div>GSTIN: {{ $order->user->gstin ?? 'N/A' }}</div>
                    </td>
                    <td style="text-align: right;">
                        <h2 style="margin: 0;">TAX INVOICE</h2>
                        <div>Invoice #: {{ $order->id }}</div>
                        <div>Date: {{ $order->created_at->format('d-M-Y') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="info-table">
            <tr>
                <td width="50%">
                    <strong>Billed From:</strong><br>
                    {{ $order->user->business_name ?? 'Smart Wholesale Distribution MS' }}<br>
                    {!! nl2br(e($order->user->business_address ?? 'Address not set')) !!}<br>
                    Phone: {{ $order->user->business_phone ?? '+91' }}
                </td>
                <td width="50%" style="text-align: right;">
                    <strong>Billed To:</strong><br>
                    {{ $order->user->name }}<br>
                    {{ $order->user->address }}<br>
                    Phone: {{ $order->user->phone }}
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th style="text-align: right;">Rate</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: center;">GST %</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: right;">&#8377;{{ number_format($item->price, 2) }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: center;">{{ $item->product->gst_percent }}%</td>
                    <td style="text-align: right;">&#8377;{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tr>
                <td>Subtotal:</td>
                <td>&#8377;{{ number_format($order->subtotal, 2) }}</td>
            </tr>

            <tr>
                <td>Total GST:</td>
                <td>&#8377;{{ number_format($order->gst_amount, 2) }}</td>
            </tr>
            <tr style="font-size: 16px; font-weight: bold; background: #f8f9fa;">
                <td>Grand Total:</td>
                <td>&#8377;{{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </table>

        <div class="gst-summary">
            <strong>GST Summary:</strong><br>
            CGST: &#8377;{{ number_format($order->gst_amount / 2, 2) }} | SGST: &#8377;{{ number_format($order->gst_amount / 2, 2) }}<br>
        </div>

        <div class="footer">
            Computer generated invoice for {{ $order->user->business_name }}. No signature required. Thank you for your business!
        </div>
    </div>
</body>
</html>
