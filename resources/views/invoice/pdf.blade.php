<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->order_id }}</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; color: #334155; margin: 0; padding: 0; background-color: #f8fafc; }
        .invoice-card { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 16px; shadow: 0 10px 15px -3px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; }
        .header { background: #1a1a1a; color: white; padding: 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; font-size: 24px; letter-spacing: 1px; text-transform: uppercase; }
        
        .content { padding: 40px; }
        .info-grid { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .info-box h6 { margin: 0 0 8px 0; color: #64748b; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; }
        .info-box p { margin: 0; font-weight: 600; font-size: 14px; line-height: 1.5; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; padding: 12px; background: #f1f5f9; color: #475569; font-size: 12px; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; }
        td { padding: 15px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }

        .totals-section { margin-top: 30px; display: flex; justify-content: flex-end; }
        .totals-table { width: 250px; }
        .totals-table tr td { border: none; padding: 5px 0; }
        .grand-total { font-size: 20px; font-weight: 900; color: #10b981; border-top: 2px solid #f1f5f9; padding-top: 10px !important; }

        .shipping-box { background: #f0fdf4; border: 1px dashed #bbf7d0; padding: 20px; border-radius: 12px; margin-top: 30px; }
        .footer { text-align: center; padding: 30px; color: #94a3b8; font-size: 12px; }
        .btn { display: inline-block; padding: 12px 30px; background: #10b981; color: white; text-decoration: none; border-radius: 30px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-card">
        <div class="header">
            <div>
                <h1>INVOICE</h1>
                <span style="color: #10b981;">#{{ $order->order_id }}</span>
            </div>
            <div style="text-align: right; font-size: 12px; opacity: 0.8;">
                Ordered on: {{ $order->created_at->format('d M Y') }}
            </div>
        </div>

        <div class="content">
            <div class="info-grid">
                <div class="info-box">
                    <h6>Billed To:</h6>
                    <p>{{ $order->name }}</p>
                    <p style="font-weight: 400;">{{ $order->email }}</p>
                    <p style="font-weight: 400;">{{ $order->phone }}</p>
                </div>
                <div class="info-box" style="text-align: right;">
                    <h6>Payment Info:</h6>
                    <p>{{ strtoupper($order->payment_method) }}</p>
                    <p style="font-weight: 400; color: #10b981;">Status: PAID</p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="font-weight: bold;">{{ $order->product_name }}</div>
                        </td>
                        <td style="text-align: center;">{{ $order->quantity }}</td>
                        <td style="text-align: right;">₹{{ number_format($order->total / $order->quantity, 2) }}</td>
                        <td style="text-align: right;">₹{{ number_format($order->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="totals-section">
                <table class="totals-table">
                    <tr>
                        <td style="color: #64748b;">Subtotal</td>
                        <td style="text-align: right; font-weight: bold;">₹{{ number_format($order->total, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="color: #64748b;">Shipping</td>
                        <td style="text-align: right; font-weight: bold;">FREE</td>
                    </tr>
                    <tr class="grand-total">
                        <td>Amount Paid</td>
                        <td style="text-align: right;">₹{{ number_format($order->total, 2) }}</td>
                    </tr>
                </table>
            </div>

            @if($order->shipping_address)
            <div class="shipping-box">
                <h6 style="margin: 0 0 5px 0; font-size: 10px; color: #166534;">📦 SHIPPING TO:</h6>
                <p style="margin: 0; font-size: 13px; color: #166534;">{{ $order->shipping_address }}</p>
            </div>
            @endif

            <div style="text-align: center;">
                <a href="{{ route('seller.orders.index') }}" class="btn">Return to Dashboard</a>
            </div>
        </div>

        <div class="footer">
            Thank you for shopping with {{ config('app.name') }}!<br>
            If you have any questions, please contact support.
        </div>
    </div>
</body>
</html>