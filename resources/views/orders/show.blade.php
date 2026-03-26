@extends('layouts.app')

@section('content')
<div class="container print:p-0 print:m-0 print:w-full print:max-w-none">
    <div class="card print:border-0 print:shadow-none">
        <div class="card-header d-flex justify-content-between align-items-center print:border-0 print:bg-transparent">
            <strong>Invoice #{{ $order->id }}</strong>
            <div class="float-end text-end">
                <div>Date: {{ $order->created_at->format('d/m/Y') }}</div>
                <div class="small text-muted mt-1">
                    Payment: <span class="badge bg-secondary text-uppercase">{{ $order->payment_method == 'pay_now' ? 'Immediate' : 'BNPL' }}</span>
                </div>
            </div>
        </div>
        <div class="card-body print:p-0">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div><strong>Smart Wholesale Distribution</strong></div>
                    <div>123 Warehouse Road</div>
                    <div>Delhi, India</div>
                    <div>Email: admin@swdms.com</div>
                    <div>Phone: +91 98765 43210</div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    @if($order->retailer)
                        <div><strong>{{ $order->retailer->name }}</strong></div>
                        <div>{{ $order->retailer->address }}</div>
                        <div>Phone: {{ $order->retailer->phone }}</div>
                    @else
                        <div><strong>{{ $order->user->name ?? 'Unknown Customer' }}</strong></div>
                        <div>{{ $order->user->address }}</div>
                        <div>Phone: {{ $order->user->phone }}</div>
                    @endif
                </div>
            </div>

            <div class="table-responsive-sm print:overflow-visible">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Item</th>
                            <th class="right">Unit Cost</th>
                            <th class="center">Qty</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $mergedItems = collect($order->items)->groupBy('product_id')->map(function($group) {
                                return (object)[
                                    'product' => $group->first()->product,
                                    'price' => $group->first()->price,
                                    'quantity' => $group->sum('quantity')
                                ];
                            })->values();
                        @endphp
                        @foreach($mergedItems as $index => $item)
                        <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td class="left strong">{{ $item->product->name ?? 'Unknown Product' }}</td>
                            <td class="right">₹{{ number_format($item->price, 2) }}</td>
                            <td class="center">{{ $item->quantity }}</td>
                            <td class="right">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-5 ms-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left"><strong>Subtotal</strong></td>
                                <td class="right">₹{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="left"><strong>GST</strong></td>
                                <td class="right">₹{{ number_format($order->gst_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="left"><strong>Total</strong></td>
                                <td class="right"><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="d-print-none text-center mt-4">
                 <div class="d-flex justify-content-center align-items-center gap-2">
                     @if(!in_array($order->status, ['completed', 'delivered']))
                         <form action="{{ route('orders.update', $order->id) }}" method="POST" class="d-inline-flex mb-0">
                             @csrf
                             @method('PUT')
                             <input type="hidden" name="status" value="completed">
                             <button type="submit" class="btn btn-warning fw-bold text-uppercase px-4 py-2 shadow-sm border-2">MARK AS COMPLETED</button>
                         </form>
                     @else
                         <span class="btn btn-success fw-bold text-uppercase px-4 py-2 cursor-default shadow-sm border-2" style="pointer-events: none; opacity: 0.9;">{{ strtoupper($order->status) }}</span>
                     @endif
                     <button onclick="window.print()" class="btn btn-primary">PRINT INVOICE</button>
                     <a href="{{ route('orders.download', $order->id) }}" class="btn btn-success">DOWNLOAD PDF</a>
                     <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('retailer.dashboard') }}" class="btn btn-secondary">BACK TO DASHBOARD</a>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
