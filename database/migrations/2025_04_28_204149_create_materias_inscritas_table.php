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
        if (!Schema::hasTable('materias_inscritas')) {
        Schema::create('materias_inscritas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gestion_id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('users_id');
            $table->tinyInteger('tp')->default(0);
            $table->tinyInteger('ex')->default(0);
            $table->tinyInteger('ad')->default(0);
            $table->tinyInteger('me')->default(0);
            $table->tinyInteger('nf')->default(0);
            $table->enum('estado',['cursando','aprobado','reprobado'])->default('cursando');
            $table->unsignedBigInteger('editor_id');

            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('gestion_id')->references('id')->on('gestion')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('materias_inscritas');
    }
};
