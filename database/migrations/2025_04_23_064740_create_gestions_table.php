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
        if (!Schema::hasTable('gestion')) {
            Schema::create('gestion', function (Blueprint $table) {
                $table->id();
                $table->string('gestion',10);
                $table->date('fechaInicio');
                $table->date('fechaFinal');
                $table->boolean('estado')->default(true);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion');
    }
};
