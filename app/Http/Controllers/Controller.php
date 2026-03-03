<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function SoloAdmin(){
        $rol = auth()->user()->rol;
        if ($rol != 'administrador'){
            abort(403, 'Rol no autorizado. No eres Administrador'); 
        }
    }

    public function SinEstudiante(){
        $rol = auth()->user()->rol;
        if ($rol === 'estudiante'){
            abort(403, 'Rol no autorizado. tienes el rol de estudiante'); 
        }
    }

}
