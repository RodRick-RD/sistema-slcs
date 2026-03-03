<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerKardex extends Controller
{
    public function lista(){
        $id = auth()->user()->id;
        $estudiante=User::findOrFail($id);

        $materias = DB::table('sem_materiainscrita as mi')
            ->select(
                'mi.gestion',
                'm.titulo',
                'mi.modalidad',
                'mi.t1',
                'mi.p1',
                'mi.n1',
                DB::raw('(mi.t1 + mi.n1 + mi.p1) as NOTA'),
                'mi.estado'
            )
            ->leftJoin('sem_materia as m', 'mi.idmateria', '=', 'm.id')
            ->where('mi.idestudiante', $id)
            //->whereNotIn('mi.estado', [4])
            ->orderByDesc('mi.gestion','mi.fecha')
            ->get();

        return view('kardex.lista',compact('estudiante','materias'));
    }
}
