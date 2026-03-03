<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriasHabilitadas extends Model
{
    use HasFactory;

    protected $table = 'sem_materiahabilitada';

    protected $fillable = [
        'idmateria',
        'estado',
        'iduser',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'fi' => 'datetime',
        'ff' => 'datetime',
    ];
    
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'idmateriahabilitada');
    }
}
