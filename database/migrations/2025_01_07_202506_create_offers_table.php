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
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('number')->default(1);
            $table->string('name')->nullable();
            $table->foreignUuid('company_id')->nullable()->constrained();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignId('price_type_id')->nullable()->constrained();
            $table->integer('status')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('public')->default(false);
            $table->text('comment')->nullable();
            
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
