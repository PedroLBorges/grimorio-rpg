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
    Schema::table('characters', function (Blueprint $table) {
        $table->integer('hp_max')->default(10);
        $table->integer('hp_current')->default(10);
    });
}

public function down(): void
{
    Schema::table('characters', function (Blueprint $table) {
        $table->dropColumn(['hp_max', 'hp_current']);
    });
}

};
