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
        Schema::create('clases', function (Blueprint $table) {
            $table->comment('Tabla que almacena las clases, lecciones o módulos impartidos por los profesores.');
            $table->id()->comment('Identificador único del registro de la clase.');
            $table->foreignId('profesor_id')
                  ->constrained('profesors')
                  ->onDelete('cascade')
                  ->comment('Referencia al profesor creador o encargado de impartir esta clase. (Un profesor puede tener varias clases)');
            $table->enum('nivel', ['a1', 'a2', 'b1', 'b2', 'c1', 'c2'])
                  ->comment('Nivel de inglés requerido o al que corresponde la clase.');
            $table->string('etiqueta')->nullable()
                  ->comment('Etiqueta o categoría corta para agrupar o clasificar la clase (ej. Verbos, Pronunciación).');
            $table->string('titulo')
                  ->comment('Título principal o nombre descriptivo de la lección.');
            $table->longText('contenido')->nullable()
                  ->comment('Contenido detallado, material, temario o instrucciones de la clase.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
