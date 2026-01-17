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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('category_id')->default(1);
            $table->foreignUuid('company_id')->nullable()->constrained();
            $table->integer('code')->unique();
            $table->string('name');
            $table->boolean('crm')->default(false);
            $table->string('partner')->nullable();
            $table->string('short_name')->nullable();
            $table->string('mxik')->nullable();
            $table->string('package_code')->nullable();
            $table->string('unit')->nullable();
            $table->string('barcode')->nullable();
            $table->text('description')->nullable();
            $table->integer('quant')->default(1);
            $table->integer('qty')->default(0);
            $table->decimal('price',15,2)->default(0);
            $table->string('acc_code')->nullable();
            $table->string('acc_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
