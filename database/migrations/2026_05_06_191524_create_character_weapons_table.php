<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('character_weapons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('ability')->default('strength'); // strength ou dexterity
            $table->boolean('proficient')->default(false);

            $table->integer('attack_bonus')->default(0); // calculado/salvo por enquanto
            $table->string('damage_dice')->nullable(); // ex: 1d8
            $table->string('damage_type')->nullable(); // ex: cortante
            $table->string('range')->nullable(); // ex: 1,5m ou 18/72m
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_weapons');
    }
};
