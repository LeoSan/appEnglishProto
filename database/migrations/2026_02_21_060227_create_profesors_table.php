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
        Schema::create('profesors', function (Blueprint $table) {
            $table->comment('Tabla que almacena la información detallada de los profesores de la institución.');
            $table->id()->comment('Identificador único del registro de profesor.');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Referencia al usuario (cuenta de acceso) asociado a este profesor.');
            $table->string('numero_empleado')->unique()->comment('Número de empleado o identificador interno único del profesor.');
            $table->string('nombre')->comment('Nombre(s) del profesor.');
            $table->string('apellidos')->comment('Apellidos del profesor.');
            $table->enum('tipo_identificacion', ['cedula', 'pasaporte', 'carnet', 'permiso'])->nullable()->comment('Tipo de documento de identificación del profesor.');
            $table->string('num_identificacion')->nullable()->comment('Número del documento de identificación correspondite.');
            $table->string('especialidad')->nullable()->comment('Especialidad o área de dominio (ej. Gramática, Conversación).');
            $table->string('telefono', 20)->nullable()->comment('Número de teléfono de contacto.');
            $table->string('url_foto')->nullable()->comment('URL o ruta de la foto de perfil del profesor.');
            $table->date('fecha_contratacion')->nullable()->comment('Fecha en la que el profesor fue contratado o inició labores.');
            $table->boolean('activo')->default(true)->comment('Indica si el profesor se encuentra impartiendo clases actualmente (1 = si, 0 = no).');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesors');
    }
};
