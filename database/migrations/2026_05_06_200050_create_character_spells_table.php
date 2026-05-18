<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('character_spells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('level')->nullable(); // truque, 1º nível, etc
            $table->string('school')->nullable(); // evocação, ilusão...
            $table->string('casting_time')->nullable();
            $table->string('range')->nullable();
            $table->string('duration')->nullable();
            $table->string('components')->nullable(); // V, S, M
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_spells');
    }
};
