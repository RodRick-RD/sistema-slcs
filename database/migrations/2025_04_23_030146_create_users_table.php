<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('img');
                $table->string('codigo');
                $table->string('nombres', 30);
                $table->string('apellidos', 30);
                $table->string('celular', 20);
                $table->string('ci', 30)->unique();
                $table->string('correo', 40)->unique();
                $table->string('password'); // nombre estándar
                $table->enum('rol', ['administrador', 'supervisor', 'estudiante']);
                $table->Decimal('debe',10,2)->unsigned()->default(0);
                $table->boolean('estado')->default(true);
                $table->unsignedBigInteger('sedes_id');
                $table->integer('id_persona')->default(0);
                $table->timestamps();

                $table->foreign('sedes_id')->references('id')->on('sedes')->onDelete('cascade');
            });
        }
/*
        DB::table('users')->insert([
            
            'nombres' => 'Admin',
            'apellidos' => 'Principal',
            'celular' => '77777777',
            'ci' => '12345678',
            'correo' => 'rod6529@gmail.com',
            'password' => Hash::make('12345678'),
            'rol' => 'administrador',
            'estado' => true,
            'sedes_id' => 1, // asegúrate de que esta sede exista
            'id_persona' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
