<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\ReportController;

/*Public Routes*/
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/collections/{category}', [ProductController::class, 'category'])->name('category.products');

Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');

/*Cart*/

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::delete('/{id}', [CartController::class, 'remove'])->name('remove');
    Route::put('/update', [CartController::class, 'update'])->name('update');
});

/*Auth Routes*/
require __DIR__.'/auth.php';

/*
 Dashboard Redirect*/


// routes/web.php
Route::post('/admin/orders/verify-otp', [OrderController::class, 'verifyOTP'])->name('admin.orders.verify-otp');
Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'seller' => redirect()->route('seller.home'),
        'buyer' => redirect()->route('user.home'),
        default => abort(403),
    };
})->middleware('auth');

/*Checkout (Authenticated)*/

Route::middleware('auth')->group(function () {

    Route::get('/customer/orders', [OrderController::class, 'customerOrders'])->name('customer.orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])
    ->name('orders.show');

Route::get('/checkout/shipping', [ShippingController::class, 'showForm'])->name('checkout.shipping');
Route::post('/checkout/shipping', [ShippingController::class, 'store'])->name('checkout.shipping.store');


    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/{product}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/checkout/payment/{shipping_id}', [CheckoutController::class, 'paymentPage'])->name('checkout.payment');

    Route::post('/checkout/process/{shipping_id}', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

 Route::get('/seller/orders/{id}', [SellerOrderController::class, 'show'])->name('seller.orders.show');
// Seller
Route::get('/seller/profile', [ProfileController::class, 'edit']);

// Buyer
Route::get('/buyer/profile', [ProfileController::class, 'edit']);
// Password Change Page dikhane ke liye (GET)
Route::get('/profile/password-update', [ProfileController::class, 'editPassword'])->name('profile.password-edit');

// Password Save karne ke liye (POST) - Jo pehle se hai
Route::post('/profile/password-update', [ProfileController::class, 'updatePassword'])
    ->name('profile.password-update');
Route::delete('seller/products/{id}/delete-image', [ProductController::class, 'deleteImage'])
    ->name('seller.products.deleteImage');
/* Stripe*/
// Order success page
// Route::get('/orders/success', [App\Http\Controllers\OrderController::class, 'success']) ->name('orders.success')
//      ->middleware('auth');
Route::post('/stripe/webhook', [StripeController::class, 'handleWebhook']);

Route::middleware('auth')->group(function () {
    Route::post('/stripe/checkout', [StripeController::class, 'createCheckoutSession'])->name('stripe.checkout');
// Is line ko dhundein:
Route::get('/stripe/success', [StripeController::class, 'successPage'])->name('stripe.success');

// Aur ise badal kar ye kar dein:
Route::get('/stripe/success', [StripeController::class, 'handleSuccess'])->name('stripe.success');
});

/*Orders*/
Route::get('/customer/orders', [OrderController::class, 'customerOrders'])
    ->name('customer.orders')
    ->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});
Route::resource('brands', BrandController::class)->only(['index', 'show']);
/*Invoice*/

Route::get('/invoice/{id}/pdf', [InvoiceController::class, 'download'])->name('invoice.pdf');

/*Admin Routes*/
Route::get('/brands/{slug}', [BrandController::class, 'show'])->name('brands.show');
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);

        Route::get('/billing/invoices', [App\Http\Controllers\Admin\BillingController::class, 'invoices'])->name('billing.invoices');
        Route::get('/billing/transactions', [App\Http\Controllers\Admin\BillingController::class, 'transactions'])->name('billing.transactions');
            Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');

    Route::get('reports/analytics', [ReportController::class, 'analytics'])->name('reports.analytics');
    Route::get('admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    //    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    

    });

/*Seller Routes*/

Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');           
Route::prefix('seller')->name('seller.')->middleware(['auth', 'role:seller'])->group(function () {
    
    // Dashboard Routes
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', function () { 
        return redirect()->route('seller.dashboard'); 
    })->name('home');

    // Product Management Routes (Sab group ke andar)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'addProduct'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    
    // 🟢 Edit, Update, aur Delete ab group ke andar hain
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/category/{id}', [ProductController::class, 'showByCategory'])->name('category.show');


Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');



Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Use POST only
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');




         Route::get('/category/{id}', [ProductController::class, 'category']) ->name('collections.category');
         Route::get('products', [ProductController::class, 'index'])->name('products.index');
         Route::put('/seller/products/{product}', [ProductController::class, 'update'])  ->name('products.update');
         Route::get('products/index', [ProductController::class, 'index'])->name('seller.products.index');
        Route::post('/products', [ProductController::class, 'store']) ->name('products.store');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

        Route::get('/orders', [SellerDashboardController::class, 'orders'])->name('orders.index');
        Route::get('/customers', [SellerDashboardController::class, 'customers'])->name('customers.index');

        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::delete('/products/images/{image}', [ProductController::class, 'deleteImage'])->name('products.deleteImage');

            Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
    });
    
//category
Route::get('/collections/{id}', [ProductController::class, 'viewCategory']) ->name('collections.category');
Route::get('/collections', [ProductController::class, 'collections'])->name('collections.index');
Route::get('/collections/{category}', [ProductController::class, 'category'])->name('collections.category');
/* Buyer Routes*/

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'role:buyer'])
    ->group(function () {
        Route::get('/home', [UserController::class, 'index'])->name('home');
    });
Route::get('/notification/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->find($id);

    if ($notification) {
        $notification->markAsRead();
    }

    return back();
})->name('notification.read');
/*Profile*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ✅ 1. Status Update Route (IMPORTANT: resource se pehle)
        Route::patch('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])
            ->name('orders.update-status');

        // ✅ 2. OTP Verification
        Route::post('/orders/verify-otp', [OrderController::class, 'verifyOTP'])
            ->name('orders.verify-otp');

        // ✅ 3. Resource Route (recommended)
        Route::resource('orders', OrderController::class);

      
    });

Route::get('/customer/orders', [OrderController::class, 'customerOrders'])
    ->name('customer.orders');
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{id}/track', [OrderController::class, 'track'])
        ->name('orders.track');
});
Route::post('/seller/orders/{id}/assign-courier',
    [\App\Http\Controllers\Seller\OrderController::class, 'assignCourier']
)->name('seller.orders.assign-courier');

Route::middleware(['auth'])->group(function () {
    // ... existing routes
    Route::get('/my-orders/{id}/track', [App\Http\Controllers\OrderController::class, 'trackOrder'])->name('orders.track');
});