<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->role === 'retailer') {
            return redirect()->route('retailer.orders.index');
        }

        $query = Order::with('retailer');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('retailer', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }


        $orders = $query->latest()->paginate(10);
        return view('orders.index', compact('orders'))
             ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'retailer') {
            return redirect()->route('retailer.catalog');
        }

        $products = Product::withoutGlobalScopes()->get();
        $retailers = Retailer::all();

        return view('orders.create', compact('retailers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'retailer_id' => 'required|exists:retailers,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'coupon_code' => 'nullable|string|exists:coupons,code',
            'payment_method' => 'required|in:pay_now,bnpl',
            'status' => 'nullable|string|in:approved,delivered',
        ]);

        try {
            DB::beginTransaction();

            $retailer = Retailer::findOrFail($request->retailer_id);
            $subtotal = 0;
            $totalGst = 0;
            $itemsToCreate = [];

            // Merge duplicate products implicitly added by user
            $mergedProducts = [];
            foreach ($request->products as $item) {
                $productId = $item['id'];
                if (isset($mergedProducts[$productId])) {
                    $mergedProducts[$productId]['quantity'] += $item['quantity'];
                } else {
                    $mergedProducts[$productId] = [
                        'id' => $productId,
                        'quantity' => $item['quantity']
                    ];
                }
            }

            // Calculate totals and verify stock
            foreach ($mergedProducts as $item) {
                $product = Product::findOrFail($item['id']);
                
                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: " . $product->name);
                }

                $lineTotal = $product->price * $item['quantity'];
                $lineGst = ($lineTotal * $product->gst_percent) / 100;

                $subtotal += $lineTotal;
                $totalGst += $lineGst;

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    // We'll deduct stock later
                    'product_model' => $product 
                ];
            }

            $discountAmount = 0;
            $couponId = null;

            if ($request->filled('coupon_code')) {
                $coupon = \App\Models\Coupon::where('code', $request->coupon_code)
                                    ->where('is_active', true)
                                    ->where(function($q) {
                                        $q->whereNull('valid_until')->orWhere('valid_until', '>=', now());
                                    })->first();

                if ($coupon) {
                    $couponId = $coupon->id;
                    if ($coupon->type === 'percent') {
                        $discountAmount = ($subtotal * $coupon->value) / 100;
                    } else {
                        $discountAmount = $coupon->value;
                    }
                    // Ensure discount isn't more than subtotal
                    $discountAmount = min($discountAmount, $subtotal);
                } else {
                    throw new \Exception("Invalid or expired coupon.");
                }
            }

            $totalAmount = ($subtotal - $discountAmount) + $totalGst;

            // AI Fraud Detection: Check if order is > 300% of Average Order Value
            $previousOrders = Order::where('retailer_id', $retailer->id)->where('status', '!=', 'Suspicious');
            $aov = $previousOrders->avg('total_amount') ?? 0;
            $isFraudulent = false;

            // If retailer has a history (AOV > 0) and this order is massive (> 3x AOV and > 10,000)
            if ($aov > 0 && $totalAmount > ($aov * 3) && $totalAmount > 10000) {
                $isFraudulent = true;
            }

            // Check Credit Limit (only if BNPL)
            if ($request->payment_method === 'bnpl' && !$isFraudulent && ($retailer->current_due + $totalAmount) > $retailer->credit_limit) {
                throw new \Exception("Credit limit exceeded. Current Due: " . $retailer->current_due . ", Order Total: " . $totalAmount . ", Limit: " . $retailer->credit_limit);
            }

            $orderStatus = 'approved';
            if ($isFraudulent) {
                $orderStatus = 'Suspicious';
            } elseif ($request->payment_method === 'pay_now') {
                $orderStatus = 'delivered';
            } elseif ($request->filled('status')) {
                $orderStatus = $request->status;
            }

            // Create Order
            $order = Order::create([
                'retailer_id' => $retailer->id,
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'coupon_id' => $couponId,
                'gst_amount' => $totalGst,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => $orderStatus 
            ]);

            // Create Items (Batch Insert for Performance)
            $orderItems = [];
            foreach ($itemsToCreate as $itemData) {
                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemData['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                // Deduct stock if not suspicious
                if (!$isFraudulent) {
                    $remainingToDeduct = $itemData['quantity'];
                    $inventories = \App\Models\Inventory::where('product_id', $itemData['product_id'])
                        ->where('quantity', '>', 0)
                        ->orderBy('created_at', 'asc') // FIFO
                        ->get();

                    foreach ($inventories as $inv) {
                        if ($remainingToDeduct <= 0) break;

                        $deductFromThis = min($inv->quantity, $remainingToDeduct);
                        $inv->decrement('quantity', $deductFromThis);
                        $remainingToDeduct -= $deductFromThis;
                    }

                    $itemData['product_model']->deductStock($itemData['quantity']);
                }
            }
            OrderItem::insert($orderItems);

            // Handle Payment Logic
            if (!$isFraudulent) {
                if ($request->payment_method === 'bnpl') {
                    $retailer->increment('current_due', $totalAmount);
                } else {
                    // Pay Now: Create a payment record
                    \App\Models\Payment::create([
                        'retailer_id' => $retailer->id,
                        'amount_paid' => $totalAmount,
                        'payment_mode' => 'Immediate',
                        'payment_date' => now(),
                        'reference_number' => 'Order #' . $order->id . ' Pre-paid',
                    ]);
                    $order->update(['status' => 'delivered']);
                }
            }

            // 16. Gamification: Update Sales Target
            $currentMonth = now()->format('Y-m');
            $target = \App\Models\SalesTarget::firstOrCreate(
                ['user_id' => auth()->id(), 'month' => $currentMonth],
                ['target_amount' => 100000]
            );
            $target->increment('achieved_amount', $totalAmount);

            // 20. Referral Reward
            if ($retailer->referred_by) {
                $referrer = Retailer::find($retailer->referred_by);
                if ($referrer) {
                    $reward = ($totalAmount * 1) / 100;
                    $referrer->increment('reward_balance', $reward);
                }
            }

            DB::commit();

            // Notifications
            if ($retailer->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($retailer->email)->send(new \App\Mail\OrderPlaced($order));
                } catch (\Exception $e) { }
            }

            \App\Services\WhatsAppService::sendMessage($retailer->phone ?? '', "Order #$order->id placed. Total: ₹$totalAmount");

            return redirect()->route('orders.index')->with('success', 'Order created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated to ' . $request->status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if (auth()->user()->role === 'retailer') {
            $retailerId = auth()->user()->retailerProfile->id ?? null;
            if ($order->retailer_id !== $retailerId) {
                abort(403, 'Unauthorized access to order.');
            }
        }

        $order->load(['items.product', 'retailer']);
        return view('orders.show', compact('order'));
    }

    /**
     * Download the order invoice as PDF.
     */
    public function downloadInvoice(Order $order)
    {
        if (auth()->user()->role === 'retailer') {
            $retailerId = auth()->user()->retailerProfile->id ?? null;
            if ($order->retailer_id !== $retailerId) {
                abort(403, 'Unauthorized access to invoice.');
            }
        }

        $order->load(['items.product', 'retailer']);
        
        $pdf = Pdf::loadView('orders.pdf_invoice', compact('order'));
        $fileName = 'Invoice_' . $order->id . '.pdf';
        $tempPath = storage_path('app/' . $fileName);
        $pdf->save($tempPath);
        return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);
    }
}
