<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriasInscritas extends Model
{
    use HasFactory;

    protected $table = 'sem_materiainscrita';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idmateriahabilitada',
        'idmateria',
        'idestudiante',
        'gestion',
        'modalidad',
        't1',
        'n1',
        'p1',
        'nf',
        'estado',
        'idp',
        'debe'
    ];

    // Relaciones

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'idmateria');
    }
    public function materiahabilitada()
    {
        return $this->belongsTo(MateriasHabilitadas::class, 'idmateriahabilitada');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'idestudiante');
    }
}
