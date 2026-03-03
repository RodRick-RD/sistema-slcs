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
        if (!Schema::hasTable('materias')) {
            Schema::create('materias', function (Blueprint $table) {
                $table->id();
                $table->string('codigo',7);
                $table->string('titulo');
                $table->boolean('sem')->default(false);
                $table->boolean('pam')->default(false);
                $table->boolean('pal')->default(false);
                $table->boolean('pnm')->default(false);
                $table->decimal('bs',6,2);
                $table->decimal('sus',6,2);
                $table->boolean('estado')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
