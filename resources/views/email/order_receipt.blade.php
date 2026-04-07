<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt #{{ $order->id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #2c3e50; }
        h4 { color: #34495e; }
        ul { padding-left: 20px; }
        .total { font-size: 1.2em; font-weight: bold; color: #27ae60; }
        .button { display: inline-block; padding: 12px 24px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Thank you for your order, {{ $order->user->name }}!</h2>

    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Transaction ID:</strong> {{ $order->transaction_id ?? 'N/A' }}</p>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>

    <h4>Your Products:</h4>
    <ul>
        @foreach($order->items as $item)
            <li>
                {{ $item->product->name }} 
                <span style="float: right;">
                    Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}
                </span>
            </li>
        @endforeach
    </ul>

    <p class="total">Total Amount: ₹{{ number_format($order->amount, 2) }}</p>

    @if($order->shipping_address)
        <p><strong>Shipping Address:</strong><br>{{ $order->shipping_address }}</p>
    @endif

    <p>We appreciate your business! Your order has been received and is being processed.</p>

    <a href="{{ route('orders.show', $order->id) }}" class="button">View Order Details</a>

    <hr style="margin: 40px 0;">
    <p style="font-size: 0.9em; color: #7f8c8d;">
        Thanks,<br>
        {{ config('app.name') }}
    </p>
</body>
</html>
