<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ControllerMateria extends Controller
{
    public function pensumlista(){

        $materias=Materia::where('pal',1)->get();
        return view('materias.lista',compact('materias'));
    }

    public function mostrarmateria(Request $request){
        try {
        $id = auth()->user()->id;
        $estudiante=User::findOrFail($id);


            $materia=Materia::select('codigo','titulo')->where('codigo', $request->codigo)->firstOrFail();
            $tareas=[];

            $tareas=Tarea::all();

            $tareas=Tarea::leftJoin('sem_materiahabilitada', 'sem_tarea.idmateriahabilitada', '=', 'sem_materiahabilitada.id')
                    ->join('sem_materia', 'sem_materiahabilitada.materia_id', '=', 'sem_materia.id') // Ajusta 'materia_id' según tu tabl
                    //->join('users', 'sem_tarea.idestudiante', '=', 'users.id')
                    ->where('sem_materia.codigo', $request->codigo)
                    ->where('sem_tarea.iduser', $id)
                    ->where('sem_materiahabilitada.estado', $id)
                    ->select(
                        'sem_tarea.fecha',
                        'sem_tarea.tipo',
                        'sem_tarea.titulo',
                        'sem_tarea.contenido',
                    )
                    ->OrderBy('sem_tarea.fecha','DESC')
                    ->get();
            
   
            return view('materias.mostrar',compact('estudiante','materia','tareas'));
    
        } catch (ModelNotFoundException $e) {
            abort(404, 'La materia solicitada no se encuentra o no está en curso.');
        }
    }
}
