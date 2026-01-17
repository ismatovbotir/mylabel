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
            $table->uuid('id')->primary();
            $table->string('payment_type')->nullable();
            $table->string('bill')->nullable();
            $table->string('agreement_number')->nullable();
            $table->date('agreement_date')->nullable();
            $table->foreignId('agreement_id')->nullable()->constrained();
            $table->foreignUuid('offer_id')->nullable()->constrained();
            $table->foreignUuid('company_id')->nullable()->constrained();
            $table->string('telegram')->nullable();
            $table->foreignUuid('user_id')->nullable()->constrained();
            $table->foreignId('price_type_id')->constrained();
            $table->integer('type')->default(0)->comment('0 from client,1 to cliend');
            $table->string('status')->default('New');
            $table->string('currency')->default('USD');
            $table->date('expiry_date')->nullable();
            $table->boolean('public')->default(false);
            $table->text('comment')->nullable();
            
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
