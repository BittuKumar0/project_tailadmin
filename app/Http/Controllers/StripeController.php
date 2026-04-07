<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Str;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    // 1. Checkout Session Create karna
    public function createCheckoutSession(Request $request)
    {
        $cart = session()->get('cart', []);
        $shippingId = $request->input('shipping_id');

        if (empty($cart) || empty($shippingId)) {
            return redirect()->back()->with('error', 'Cart is empty or shipping address missing.');
        }

        $lineItems = [];
        $productNames = [];
        $totalQty = 0;

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => ['name' => $item['name']],
                    'unit_amount' => $item['sale_price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
            $productNames[] = $item['name'] . ' (x' . $item['quantity'] . ')';
            $totalQty += $item['quantity'];
        }

        $session = StripeSession::create([
               'phone_number_collection' => [
        'enabled' => true,
    ],
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.shipping'),
            'metadata' => [
                'user_id'      => auth()->id(),
                'shipping_id'  => $shippingId,
              
                'product_name' => implode(', ', $productNames),
                'total_qty'    => $totalQty,
                'order_items'  => json_encode($cart), 
            'product_id' => implode(',', array_column($cart, 'id')),
               'price'        => collect($cart)->sum(fn($item) => $item['sale_price'] * $item['quantity']),
            ],
        ]);

        return redirect($session->url);
    }

    // 2. Success Handle karna (Jab User wapas aaye)
    public function handleSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('cart.index')->with('error', 'Invalid Session');
        }

        try {
            $session = StripeSession::retrieve($sessionId);
            
            // Check karein order pehle hi ban toh nahi gaya (via Webhook)
            $order = Order::where('stripe_payment_id', $session->id)->first();

            if (!$order) {
                $order = Order::create([
                    'order_id'          => 'ORD-' . strtoupper(Str::random(10)),
                    'user_id'           => $session->metadata->user_id,
                    'seller_id'         => 3, // Fixed Seller ID as requested
                    'product_id'        =>  $session->metadata->product_id,
                    'shipping_id'       => $session->metadata->shipping_id,
                    'product_name'      => $session->metadata->product_name ?? 'Multiple Products',
                    'quantity'          => $session->metadata->total_qty ?? 1,
                    'price'             => $session->metadata->price,
                    'total'             => $session->amount_total / 100,
                    'payment_status'    => 'paid',
                    'payment_method'    => 'stripe',
                    'stripe_payment_id' => $session->id,
                    'status'            => 'ordered',
                    // Customer Details from Stripe
                    'name'              => $session->customer_details->name ?? 'Customer',
                    'phone' => $session->customer_details->phone ?? '',
                    'email'             => $session->customer_details->email ?? '',
                    'address'           => $session->customer_details->address->line1 ?? '',
                ]);
            }

            session()->forget('cart');
            return view('order.success', compact('order'));

        } catch (\Exception $e) {
            return redirect()->route('orders.index')->with('error', $e->getMessage());
        }
    }

    // 3. Webhook (Backup logic agar user browser band kar de)
    public function handleWebhook(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $type = $payload['type'] ?? null;

        if ($type === 'checkout.session.completed') {
            $session = $payload['data']['object'];
            $meta = $session['metadata'] ?? [];

            if (isset($meta['shipping_id']) && isset($meta['user_id'])) {
                $exists = Order::where('stripe_payment_id', $session['id'])->exists();
                
                if (!$exists) {
                    Order::create([
                        'order_id'          => 'ORD-' . strtoupper(Str::random(10)),
                        'user_id'           => $meta['user_id'],
                        'seller_id'         => 3,
                        'product_id'        => $meta['product_id'] ?? null,
                        'shipping_id'       => $meta['shipping_id'],
                        'product_name'      => $meta['product_name'] ?? 'Products',
                        'quantity'          => $meta['total_qty'] ?? 1,
                        'price'             => $meta['price'] ?? ($session['amount_total'] / 100), 
                        'total'             => $session['amount_total'] / 100,
                        'payment_status'    => 'paid',
                        'payment_method'    => 'stripe',
                        'stripe_payment_id' => $session['id'],
                        'status'            => 'ordered',
                        'name'              => $session['customer_details']['name'] ?? 'Customer',
                        'email'             => $session['customer_details']['email'] ?? '',
                        'address'           => $session['customer_details']['address']['line1'] ?? '',
                    ]);
                }
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function showPaymentPage()
    {
        $cart = session()->get('cart', []);
        $totalAmount = collect($cart)->sum(fn($item) => $item['sale_price'] * $item['quantity']);
        return view('stripe.payment', compact('cart', 'totalAmount'));
    }
}