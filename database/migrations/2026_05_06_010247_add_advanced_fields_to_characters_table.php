<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {

            // Cabeçalho
            $table->string('player_name')->nullable();
            $table->string('background')->nullable();
            $table->string('alignment')->nullable();
            $table->integer('experience')->default(0);

            // Movimentação
            $table->integer('speed')->default(30);

            // Moedas
            $table->integer('cp')->default(0);
            $table->integer('sp')->default(0);
            $table->integer('ep')->default(0);
            $table->integer('gp')->default(0);
            $table->integer('pp')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn([
                'player_name',
                'background',
                'alignment',
                'experience',
                'speed',
                'cp',
                'sp',
                'ep',
                'gp',
                'pp',
            ]);
        });
    }
};
