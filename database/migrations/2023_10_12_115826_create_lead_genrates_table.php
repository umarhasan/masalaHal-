<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_genrates', function (Blueprint $table) {
            $table->id();
            $table->string('need')->nullable();
            $table->string('business')->nullable();
            $table->string('industry')->nullable();
            $table->string('live_website')->nullable();
            $table->string('budget')->nullable();
            $table->string('hire')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('zip')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_genrates');
    }
};
