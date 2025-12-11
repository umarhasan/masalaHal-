<?php

// 2025_12_11_000001_update_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // owner (seller/admin)
            $table->unsignedBigInteger('brand_id')->nullable()->after('category_id');
            $table->string('sku')->nullable()->after('slug');
            $table->enum('condition', ['new','used','refurbished'])->default('new')->after('status');
            $table->boolean('is_wholesale')->default(false)->after('condition');
            $table->integer('min_qty')->nullable()->after('is_wholesale');
            $table->decimal('wholesale_price', 10,2)->nullable()->after('min_qty');
            $table->decimal('sale_price', 10,2)->nullable()->after('price');
            $table->boolean('is_approved')->default(false)->after('sale_price'); // admin approval for marketplace
            $table->index(['category_id']);
            $table->index(['user_id']);
            $table->index(['is_approved']);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'user_id','brand_id','sku','condition','is_wholesale','min_qty','wholesale_price','sale_price','is_approved'
            ]);
        });
    }
};

