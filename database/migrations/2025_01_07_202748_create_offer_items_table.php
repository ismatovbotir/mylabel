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
        Schema::create('offer_items', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('offer_id')->constrained();
            $table->foreignUuid('item_id')->constrained();
            $table->integer('qty')->default(1);
            $table->double('price',10,2);
            $table->string('currency')->default('UZS');
            $table->string('comment')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_items');
    }
};
