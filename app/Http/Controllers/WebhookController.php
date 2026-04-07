<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
public function handleWebhook(Request $request)
{
    \Log::info('Stripe Webhook Hit');
    $payload = $request->all();

    try {
        $type = $payload['type'] ?? '';

        if ($type === 'checkout.session.completed') {
            $session = $payload['data']['object'];
            $meta = $session['metadata'] ?? [];

            // StripeController se aane wala data
            $userId     = $meta['user_id'] ?? null;
            $shippingId = $meta['shipping_id'] ?? null;
            
            // Check karein agar order_items metadata mein hai, warna product_name fallback use karein
            $cartItems  = json_decode($meta['order_items'] ?? '[]', true);
            $productNameFromMeta = $meta['product_name'] ?? 'Cart Items';
            $totalQtyFromMeta = $meta['total_qty'] ?? 1;

            if ($userId && $shippingId) {
                // Duplicate entry rokne ke liye check
                $exists = Order::where('stripe_payment_id', $session['id'])->exists();

                if (!$exists) {
                    $productNames = [];
                    $totalQty = 0;

                    if (!empty($cartItems)) {
                        foreach ($cartItems as $item) {
                            $productNames[] = $item['name'];
                            $totalQty += $item['quantity'];
                        }
                    } else {
                        // Agar JSON empty hai toh direct metadata fields use karein
                        $productNames[] = $productNameFromMeta;
                        $totalQty = $totalQtyFromMeta;
                    }

                    Order::create([
                        'order_id'          => 'ORD-' . strtoupper(uniqid()),
                        'user_id'           => $userId,
                        'seller_id'         => 3, // Aapka default seller
                        'shipping_id'       => $shippingId,
                        'product_name'      => implode(', ', $productNames),
                        'quantity'          => $totalQty,
                        'total'             => ($session['amount_total'] ?? 0) / 100,
                        'payment_method'    => 'stripe',
                        'payment_status'    => 'paid',
                        'stripe_payment_id' => $session['id'], // ✅ Ye ID ab save hogi
                        'status'            => 'ordered',
                    ]);

                    \Log::info('Order Created via Webhook: ' . $session['id']);
                }
            }
        }

        return response()->json(['status' => 'success']);

    } catch (\Exception $e) {
        \Log::error('Webhook Error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 400);
    }
}
}