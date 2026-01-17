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
        Schema::create('telegram_messages', function (Blueprint $table) {
            $table->id();

           

            $table->foreignUuid('order_id')->nullable()->constrained();
            $table->unsignedBigInteger('telegram_id');
            $table->integer('bdb')->default(0);
            $table->string('type')->default('text');
            $table->text('text')->nullable();
            $table->string('business_connection_id')->nullable();
            $table->bigInteger('update_id');
            $table->bigInteger('message_id');
            $table->bigInteger('reply')->nullable();
            $table->unsignedBigInteger('telegram_date');
            $table->json('links')->nullable();
            $table->json('obj')->nullable();

            $table->timestamps();
            $table->foreign('telegram_id')->references('id')->on('telegrams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_messages');
    }
};
