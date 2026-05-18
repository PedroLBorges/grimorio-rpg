<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->boolean('strength_save_proficient')->default(false);
            $table->boolean('dexterity_save_proficient')->default(false);
            $table->boolean('constitution_save_proficient')->default(false);
            $table->boolean('intelligence_save_proficient')->default(false);
            $table->boolean('wisdom_save_proficient')->default(false);
            $table->boolean('charisma_save_proficient')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn([
                'strength_save_proficient',
                'dexterity_save_proficient',
                'constitution_save_proficient',
                'intelligence_save_proficient',
                'wisdom_save_proficient',
                'charisma_save_proficient',
            ]);
        });
    }
};
