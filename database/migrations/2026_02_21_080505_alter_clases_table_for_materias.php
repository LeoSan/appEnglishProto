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
        Schema::table('clases', function (Blueprint $table) {
            $table->dropForeign(['profesor_id']);
            $table->dropColumn('profesor_id');
            $table->foreignId('materia_id')->nullable()->constrained('materias')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clases', function (Blueprint $table) {
            $table->dropForeign(['materia_id']);
            $table->dropColumn('materia_id');
            $table->foreignId('profesor_id')->nullable()->constrained('profesors')->onDelete('cascade')->after('id');
        });
    }
};
