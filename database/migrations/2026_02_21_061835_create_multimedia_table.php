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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->comment('Tabla que almacena los recursos multimedia (audios, videos, infografías) asociados a las clases.');
            $table->id()->comment('Identificador único del registro multimedia.');
            $table->foreignId('clase_id')
                  ->constrained('clases')
                  ->onDelete('cascade')
                  ->comment('Referencia a la clase a la que pertenece este recurso multimedia.');
            $table->string('titulo')
                  ->comment('Título o nombre descriptivo del recurso multimedia.');
            $table->text('descripcion')->nullable()
                  ->comment('Breve descripción o notas sobre el contenido del recurso.');
            $table->enum('tipo', ['audio', 'video', 'infografia'])
                  ->comment('Tipo de formato del recurso multimedia (audio, video o infografia).');
            $table->string('url')
                  ->comment('URL, ruta o enlace donde se encuentra alojado el archivo.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};
