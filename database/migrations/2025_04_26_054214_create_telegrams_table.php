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
        Schema::create('telegrams', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('business_connection_id')->nullable();
            $table->foreignUuid('user_id')->nullable()->constrained();
            $table->foreignUuid('company_id')->nullable()->constrained();
            //telegram
            $table->boolean('is_bot')->default(false);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('language_code')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();

            //$table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegrams');
    }
};
