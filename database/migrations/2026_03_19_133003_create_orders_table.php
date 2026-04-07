<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->string('order_id'); // Unique ID for each checkout (e.g. ORD-12345)
        
        // Relationships
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('seller_id')->nullable();
        $table->unsignedBigInteger('product_id');

        // Product Details
        $table->string('product_name'); // Product ka naam save karna zaroori hai
        $table->integer('quantity');
        $table->decimal('price', 15, 2); // Single product price
        $table->decimal('total', 15, 2); // price * quantity

        // Customer Info (Shipping)
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->text('address');

        // Status & Payment
        $table->string('payment_method'); // cod, stripe
        $table->string('payment_status')->default('pending'); // pending, paid, failed
        $table->string('status')->default('ordered'); // ordered, shipped, delivered, cancelled

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
