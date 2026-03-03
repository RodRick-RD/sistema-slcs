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
        if (!Schema::hasTable('materiashabilitadas')) {
        Schema::create('materiashabilitadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gestion_id');
            $table->unsignedBigInteger('materia_id');
            $table->boolean('estado')->default(true);

            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('gestion_id')->references('id')->on('gestion')->onDelete('cascade');
        });
    }
    }

    public function down(): void
    {
       // Schema::dropIfExists('materias_habilitadas');
    }
};
