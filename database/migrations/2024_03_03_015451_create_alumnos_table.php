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
            $table->id();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('grupo_id')->nullable(); // Clave foránea para referenciar la tabla de grupos
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('set null');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable()->unique();
            $table->string('email')->unique();
             // Nuevos campos para actividades
             $table->unsignedBigInteger('arte_id')->nullable(); // Clave foránea para referenciar la tabla de arte
             $table->foreign('arte_id')->references('id')->on('artes')->onDelete('set null');
             $table->unsignedBigInteger('fisica_id')->nullable(); // Clave foránea para referenciar la tabla de fisica
             $table->foreign('fisica_id')->references('id')->on('fisicas')->onDelete('set null');
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
