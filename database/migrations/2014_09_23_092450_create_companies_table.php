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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable();
            $table->string('stir')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('fullName')->nullable();
            $table->string('address')->nullable();
            $table->integer('main')->default(0);
            $table->foreignId('price_type_id')->default(1);
            $table->string('mob')->nullable();
            $table->string('telegram')->nullable();
            $table->foreignUuid('lead_id')->nullable()->constrained();
            $table->boolean('one_time')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
