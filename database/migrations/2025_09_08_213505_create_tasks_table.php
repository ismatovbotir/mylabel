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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('control')->default(false);
            $table->foreignUuid('user_id')->nullable()->constrained();
            $table->foreignUuid('author')->references('id')->on('users');
            $table->string('title');
            $table->text('task');
            $table->string('type')->default('task');
            $table->string('doc_id')->nullable();
            $table->string('status')->default('new');
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
