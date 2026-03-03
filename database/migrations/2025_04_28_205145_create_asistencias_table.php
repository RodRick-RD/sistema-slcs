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
        if (!Schema::hasTable('asistencias')) {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->date('fechaRegistro');
            $table->time('horaRegistro');
            $table->unsignedBigInteger('materias_inscritas_id');

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('materias_inscritas_id')->references('id')->on('materias_inscritas')->onDelete('cascade');

        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
