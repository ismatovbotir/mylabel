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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id');
            $table->foreignUuid('user_id');
            $table->enum('type',['sell','buy','other'])->default('sell');
            $table->string('prefix')->nullable();
            $table->integer('number')->default(1);
            $table->date('start_date');
            $table->date('end_date')->nullable();

           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
