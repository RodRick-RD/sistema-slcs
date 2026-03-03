<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'sem_tarea';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'tipo',
        'titulo',
        'contenido',
        'idestudiante',
        'idmateriashabilitada',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'estado' => 'boolean',
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'idestudiante');
    }

    /**
     * Relación con materia habilitada.
     */
    public function materiaHabilitada()
    {
        return $this->belongsTo(MateriasHabilitadas::class, 'idmateriahabilitada');
    }
}
