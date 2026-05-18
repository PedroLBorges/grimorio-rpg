<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('acrobatics')->default(0);
            $table->integer('animal_handling')->default(0);
            $table->integer('arcana')->default(0);
            $table->integer('athletics')->default(0);
            $table->integer('performance')->default(0);
            $table->integer('deception')->default(0);
            $table->integer('stealth')->default(0);
            $table->integer('history')->default(0);
            $table->integer('intimidation')->default(0);
            $table->integer('insight')->default(0);
            $table->integer('investigation')->default(0);
            $table->integer('medicine')->default(0);
            $table->integer('nature')->default(0);
            $table->integer('perception')->default(0);
            $table->integer('persuasion')->default(0);
            $table->integer('sleight_of_hand')->default(0);
            $table->integer('religion')->default(0);
            $table->integer('survival')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn([
                'acrobatics',
                'animal_handling',
                'arcana',
                'athletics',
                'performance',
                'deception',
                'stealth',
                'history',
                'intimidation',
                'insight',
                'investigation',
                'medicine',
                'nature',
                'perception',
                'persuasion',
                'sleight_of_hand',
                'religion',
                'survival',
            ]);
        });
    }
};
