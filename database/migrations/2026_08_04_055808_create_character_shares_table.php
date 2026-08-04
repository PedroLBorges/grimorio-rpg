<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('character_shares', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('permission', ['view', 'edit'])
                ->default('view');

            $table->timestamps();

            $table->unique(['character_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_shares');
    }
};
