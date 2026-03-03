<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\Materia;
use App\Models\MateriasInscritas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ControllerNota extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gestiones=Gestion::where('estado',1)->orderByDesc('id')->get();
        $materias=Materia::where('sem',1)->get();
        $estudiantes = null;
        $selectedGestion = null;
        $selectedMateria = null;

        if ($request->isMethod('post')) {
            $selectedGestion = $request->input('gestion_id');
            $selectedMateria = $request->input('materia_id');

            Session(['gestion_id' => $selectedGestion]);
            Session(['materia_id' => $selectedMateria]);

            $estudiantes = ""; 
            $estudiantes = DB::table('materias_inscritas as mi')
            ->select(
                'mi.id',
                'u.nombres',
                'u.apellidos',
                'mi.tp',
                'mi.ex',
                'mi.ad',
                'mi.nf',
                'mi.me',
                'mi.estado'
            )
            ->join('users as u', 'mi.users_id', '=', 'u.id')
            ->where('mi.gestion_id', $selectedGestion)
            ->where('mi.materia_id', $selectedMateria)
            ->whereNotIn('mi.estado', [4])
            ->get();
                    

            return view('nota.lista', compact(
                'gestiones',
                'materias',
                'estudiantes',
                'selectedGestion',
                'selectedMateria'
            ));
        }elseif(Session::has('gestion_id') && Session::has('materia_id')){
            $selectedGestion = session('gestion_id');
            $selectedMateria = session('materia_id');

            $estudiantes = ""; 
            $estudiantes = DB::table('materias_inscritas as mi')
            ->select(
                'mi.id',
                'u.nombres',
                'u.apellidos',
                'mi.tp',
                'mi.ex',
                'mi.ad',
                'mi.nf',
                'mi.me',
                'mi.estado'
            )
            ->join('users as u', 'mi.users_id', '=', 'u.id')
            ->where('mi.gestion_id', $selectedGestion)
            ->where('mi.materia_id', $selectedMateria)
            ->whereNotIn('mi.estado', [4])
            ->get();
                    

            return view('nota.lista', compact(
                'gestiones',
                'materias',
                'estudiantes',
                'selectedGestion',
                'selectedMateria'
            ));

        }
        return view('nota.lista',compact('gestiones','materias'));
        
    }

    public function editar($id){
        $nota = MateriasInscritas::findOrFail($id);
        $estudiante=User::findOrFail($nota->users_id);
        return view('nota.editar',compact('nota','estudiante'));
    }

    public function guardarbd(Request $request,$id){

        $request->validate([ 
            'tp' => 'required|numeric|min:0|max:100',
            'ex' => 'required|numeric|min:0|max:100',
            'ad' => 'required|numeric|min:0|max:100',
            'me' => 'required|numeric|min:0|max:100',
        ]); 
        $tp = (float)($request->tp ?? 0);
        $ex = (float)($request->ex ?? 0);
        $na = (float)($request->ad ?? 0);
        
        $sum = $tp + $ex + $na;

        if ($sum > 100) {
            throw ValidationException::withMessages([
                'nf' => 'La suma de las notas (TP, EX, NA) no puede exceder de 100.',
            ]);
        }

        if ($tp > 0 || $ex > 0 || $na > 0) {
            $request['me'] = 0;
        }


        $materias = MateriasInscritas::findOrFail($id); 
        $materias->tp=$request->tp;
        $materias->ex=$request->ex;
        $materias->ad=$request->ad;
        $materias->me=$request->me;
        $materias->nf=$sum;
        $materias->editor_id=auth()->user()->id;
        $materias->save(); 

        return redirect()->to('/notas')->with('success', 'Nota actualizada del estudiante.');
    }
}
