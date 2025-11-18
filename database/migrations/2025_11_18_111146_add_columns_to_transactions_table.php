<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {

            if (!Schema::hasColumn('transactions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            if (!Schema::hasColumn('transactions', 'package_id')) {
                $table->string('package_id')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('transactions', 'transaction_id')) {
                $table->string('transaction_id')->after('package_id');
            }

            if (!Schema::hasColumn('transactions', 'amount')) {
                $table->decimal('amount', 8, 2)->after('transaction_id');
            }

            if (!Schema::hasColumn('transactions', 'status')) {
                $table->string('status')->after('amount');
            }
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'package_id',
                'transaction_id',
                'amount',
                'status',
            ]);
        });
    }
};
