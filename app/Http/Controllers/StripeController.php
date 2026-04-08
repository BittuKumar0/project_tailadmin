<?php

namespace App\Http\Controllers;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    // 1. Show Payment Page (with Stripe button)
    public function showPaymentPage(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalAmount = collect($cart)->sum(fn($item) => $item['sale_price'] * $item['quantity']);
        $shippingId = $request->input('shipping_id');

        if (!$shippingId) {
            return redirect()->route('cart.index')->with('error', 'Shipping address missing.');
        }

        return view('stripe.payment', compact('cart', 'totalAmount', 'shippingId'));
    }

    // 2. Create Stripe Checkout Session
    public function createCheckoutSession(Request $request)
    {
        $cart = session()->get('cart', []);
        $shippingId = $request->input('shipping_id');

        if (empty($cart) || !$shippingId) {
            return redirect()->route('cart.index')->with('error', 'Cart or shipping address missing.');
        }

        $lineItems = [];
        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => ['name' => $item['name']],
                    'unit_amount' => $item['sale_price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cart.index'),
                'metadata' => [
                    'user_id'     => auth()->id(),
                    'shipping_id' => $shippingId,
                    'order_items' => json_encode($cart),
                ],
            ]);

            // Redirect to Stripe checkout
            return redirect($session->url);

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Stripe checkout error: ' . $e->getMessage());
        }
    }

    // 3. Stripe Success Page (deduct stock + create order)
   
public function handleSuccess(Request $request)
{
    $sessionId = $request->get('session_id');

    if (!$sessionId) {
        return redirect()->route('cart.index')->with('error', 'Invalid Stripe session.');
    }

    try {
        $session = StripeSession::retrieve($sessionId);
        $meta = $session->metadata;
        $cartItems = json_decode($meta->order_items, true);

        DB::transaction(function () use ($cartItems, $session, $meta) {
            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                if (!$product) {
                    throw new \Exception("Product not found: {$item['name']}");
                }
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                // Deduct stock
                $product->decrement('stock', $item['quantity']);

                // Create order
                $order = Order::create([
                    'order_id'          => 'ORD-' . strtoupper(Str::random(10)),
                    'user_id'           => $meta->user_id,
                    'seller_id'         => $item['seller_id'] ?? null,
                    'product_id'        => $item['id'],
                    'shipping_id'       => $meta->shipping_id,
                    'product_name'      => $item['name'],
                    'quantity'          => $item['quantity'],
                    'price'             => $item['sale_price'],
                    'total'             => $item['sale_price'] * $item['quantity'],
                    'payment_status'    => 'paid',
                    'payment_method'    => 'stripe',
                    'stripe_payment_id' => $session->id,
                    'status'            => 'ordered',
                    'name'              => $session->customer_details->name ?? 'Customer',
                    'phone'             => $session->customer_details->phone ?? '',
                    'email'             => $session->customer_details->email ?? '',
                    'address'           => $session->customer_details->address->line1 ?? '',
                ]);

                // Notify seller
                if ($order->seller_id) {
                    $seller = User::find($order->seller_id);
                    if ($seller) {
                        $seller->notify(new NewOrderNotification($order));
                    }
                }
            }
        });

        session()->forget('cart');
        return view('order.index', compact('session'));

    } catch (\Exception $e) {
        return redirect()->route('orders.index')->with('error', 'Stripe order failed: ' . $e->getMessage());
    }
}
}