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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('power'); // Siła karty
            $table->timestamps();
        });

        Schema::create('card_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id');
            $table->json('config'); // Konfiguracja karty, np. super moc
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
        Schema::dropIfExists('card_configs');
    }
};
