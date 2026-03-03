<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'sem_materia';

    protected $fillable = [
        'codigo',
        'titulo',
        'sem',
        'pam',
        'pal',
        'pnm',
        'bs',
        'sus',
        'estado',
    ];

    protected $casts = [
        'sem' => 'boolean',
        'pam' => 'boolean',
        'pal' => 'boolean',
        'pnm' => 'boolean',
        'estado' => 'boolean',
        'bs' => 'decimal:2',
        'sus' => 'decimal:2',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'idmateria');
    }
}
