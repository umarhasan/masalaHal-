<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            // User who submitted the quote
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Optional: Company assigned to the quote
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('set null');
            // Quote details
            $table->string('title');
            $table->text('description');

            // Status of the quote
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
