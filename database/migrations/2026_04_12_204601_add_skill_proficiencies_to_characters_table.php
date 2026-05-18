<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->boolean('acrobatics_proficient')->default(false);
            $table->boolean('animal_handling_proficient')->default(false);
            $table->boolean('arcana_proficient')->default(false);
            $table->boolean('athletics_proficient')->default(false);
            $table->boolean('performance_proficient')->default(false);
            $table->boolean('deception_proficient')->default(false);
            $table->boolean('stealth_proficient')->default(false);
            $table->boolean('history_proficient')->default(false);
            $table->boolean('intimidation_proficient')->default(false);
            $table->boolean('insight_proficient')->default(false);
            $table->boolean('investigation_proficient')->default(false);
            $table->boolean('medicine_proficient')->default(false);
            $table->boolean('nature_proficient')->default(false);
            $table->boolean('perception_proficient')->default(false);
            $table->boolean('persuasion_proficient')->default(false);
            $table->boolean('sleight_of_hand_proficient')->default(false);
            $table->boolean('religion_proficient')->default(false);
            $table->boolean('survival_proficient')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn([
                'acrobatics_proficient',
                'animal_handling_proficient',
                'arcana_proficient',
                'athletics_proficient',
                'performance_proficient',
                'deception_proficient',
                'stealth_proficient',
                'history_proficient',
                'intimidation_proficient',
                'insight_proficient',
                'investigation_proficient',
                'medicine_proficient',
                'nature_proficient',
                'perception_proficient',
                'persuasion_proficient',
                'sleight_of_hand_proficient',
                'religion_proficient',
                'survival_proficient',
            ]);
        });
    }
};
