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
        Schema::create('duel_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('duel_id');
            $table->unsignedBigInteger('user_id');
            $table->text('action'); // Logowana akcja, np. "Wybór karty"
            $table->timestamps();

            $table->foreign('duel_id')->references('id')->on('duels')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duel_logs');
    }
};
