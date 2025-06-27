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
        Schema::disableForeignKeyConstraints();

        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Campos en español (coinciden con tu Excel/CSV)
            $table->string('titulo');
            $table->string('autor');
            $table->string('correo_autor')->nullable();
            $table->string('familia_profesional');
            $table->string('ciclo_formativo');
            $table->text('resumen');
            $table->string('curso_academico')->nullable;
            $table->string('palabras_clave')->nullable();
            $table->string('area_tematica')->nullable;
            $table->string('enlace_recursos')->nullable();
            $table->text('comentarios_profesor')->nullable();

            // Relaciones existentes
            //Todo revisar el concepto nullable aquí, de momento para importar csv lo dejo así.
            $table->foreignId('enrollment_id')->nullable()->constrained();
            $table->foreignId('teacher_id')->nullable()->constrained('users');
            $table->foreignId('enrollment_user_id')->nullable();

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
