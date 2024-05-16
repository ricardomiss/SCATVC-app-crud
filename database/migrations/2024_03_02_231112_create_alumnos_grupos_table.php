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
        Schema::create('alumnos_grupos', function (Blueprint $table) {
            $table->unsignedBigInteger('alumnos_id');
            $table->unsignedBigInteger('grupos_id'); // Cambiado de 'grupo_id' a 'grupos_id'
            // Añade cualquier otra columna adicional que necesites en la tabla pivot
            // Por ejemplo, puedes agregar timestamps
            $table->timestamps();

            // Define las claves foráneas
            $table->foreign('alumnos_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('grupos_id')->references('id')->on('grupos')->onDelete('cascade'); // Cambiado de 'grupo_id' a 'grupos_id'

            // Define la clave primaria compuesta
            $table->primary(['alumnos_id', 'grupos_id']); // Cambiado de 'grupo_id' a 'grupos_id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos_grupos');
    }
};
