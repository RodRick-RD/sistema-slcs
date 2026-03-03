<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $estudianteId = $request->id;
        $rol = auth()->user()->rol;


        if ($rol === 'estudiante') {
            abort(403, 'Eres ESTUDIANTE y no puedes acceder a estas operaciones.');
        }elseif ($rol === 'administrador') {
            return $next($request);
        }elseif($rol === 'supervisor'){
            $user=User::findOrFail($estudianteId);
            $user_sede=$user->sedes_id;
            if(auth()->user()->sedes_id!=$user_sede){
                abort(403, 'NO TIENES PERMISO PARA ADMINISTRAR DATOS DE ESTE USUARIO.');
            }else{
                return $next($request);
            }

        }

        return $next($request);
    }
}
