<?php

// 2025_12_11_000005_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number')->unique();
            $table->decimal('sub_total', 10,2);
            $table->decimal('shipping', 10,2)->default(0);
            $table->decimal('tax', 10,2)->default(0);
            $table->decimal('total', 10,2);
            $table->enum('status', ['pending','processing','shipped','delivered','cancelled','refunded'])->default('pending');
            $table->text('shipping_address');
            $table->text('billing_address')->nullable();
            $table->json('meta')->nullable(); // store gateway data
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->index(['user_id','order_number']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
    public function down() {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};

