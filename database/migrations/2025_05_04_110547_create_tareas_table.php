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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha')->nullable();
            $table->enum('tipo',['texto','video'])->default('texto');
            $table->string('titulo');
            $table->longText('contenido');
            $table->boolean('estado')->default(true);
            
            $table->unsignedBigInteger('users_id')->default(0);
            $table->unsignedBigInteger('materiashabilitadas_id');

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('materiashabilitadas_id')->references('id')->on('materiashabilitadas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
