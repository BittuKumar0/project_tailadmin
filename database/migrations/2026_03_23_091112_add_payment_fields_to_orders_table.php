<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('payment_method')->nullable()->after('total_amount'); // cod, stripe, etc.
        $table->string('payment_status')->default('pending')->after('payment_method'); // pending, paid, failed
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['payment_method', 'payment_status']);
    });
}
};
