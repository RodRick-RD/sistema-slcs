<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Decimal;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->enum('tipo', ['materia', 'libro'])->default('materia');
            $table->unsignedBigInteger('materias_inscritas_id');
            $table->Decimal('debe',10,2)->unsigned()->default(0);
            $table->Decimal('haber',10,2)->unsigned()->default(0);
            $table->unsignedBigInteger('editor_id');
            $table->boolean('estado')->default(true);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('materias_inscritas_id')->references('id')->on('materias_inscritas')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
