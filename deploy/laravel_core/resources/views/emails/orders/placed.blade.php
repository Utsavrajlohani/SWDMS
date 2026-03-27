<x-mail::message>
# Order Placed Successfully!

Hello, your order **#{{ $order->id }}** has been recorded in the SWDMS portal.

**Order Summary:**
- **Total Amount:** ₹{{ number_format($order->total_amount, 2) }}
- **Payment Method:** {{ $order->payment_method == 'pay_now' ? 'Immediate Payment' : 'BNPL' }}
- **Status:** {{ ucfirst($order->status) }}

<x-mail::button :url="route('orders.show', $order->id)">
View Order Details
</x-mail::button>

Thanks for doing business with us!<br>
**{{ config('app.name') }} Team**
</x-mail::message>
