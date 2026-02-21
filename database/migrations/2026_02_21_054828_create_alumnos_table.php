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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->comment('Tabla que almacena la información específica de los estudiantes/alumnos.');
            $table->id()->comment('Identificador único del registro de alumno.');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Referencia al usuario (cuenta de acceso) asociado a este alumno.');
            $table->string('matricula')->unique()->comment('Número de control o matrícula única del estudiante.');
            $table->string('nombre')->comment('Nombre(s) del estudiante.');
            $table->string('apellidos')->comment('Apellidos del estudiante.');
            $table->enum('nivel', ['a1', 'a2', 'b1', 'b2', 'c1', 'c2'])->default('a1')->comment('Nivel actual de inglés del estudiante.');
            $table->date('fecha_nacimiento')->nullable()->comment('Fecha de nacimiento del estudiante.');
            $table->string('genero', 20)->nullable()->comment('Género del estudiante (ej. M, F, Otro).');
            $table->string('telefono', 20)->nullable()->comment('Número de teléfono de contacto.');
            $table->text('direccion')->nullable()->comment('Dirección de residencia del estudiante.');
            $table->date('fecha_inscripcion')->nullable()->comment('Fecha en la que el estudiante se inscribió a la institución.');
            $table->boolean('activo')->default(true)->comment('Indica si el estudiante está activo (1) o inactivo/suspendido (0).');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
