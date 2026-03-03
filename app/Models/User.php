<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'img',
        'nombres',
        'apellidos',
        'celular',
        'ci',
        'correo',
        'password',
        'rol',
        'estado',
        'idrd',
        'idp',
    ];

    protected $hidden = [
        'password',
    ];

    // Laravel usa "email" por defecto, así que debes especificar:
    public function getAuthIdentifierName()
    {
        return 'correo';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'idrd');
    }
}
