<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
       public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->string('slug')->nullable()->after('name');
            $table->string('image')->nullable()->after('description');
            $table->integer('stock')->default(0)->after('price');
            $table->boolean('status')->default(1)->after('stock'); // 1 = active

        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'category_id',
                'slug',
                'image',
                'stock',
                'status'
            ]);
        });
    }

};
