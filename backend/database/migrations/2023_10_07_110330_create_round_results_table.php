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
        Schema::create('round_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('round_id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('card_id');
            $table->timestamps();

            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('round_results');
    }
};
