<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerUser extends Controller
{
    public function redirigirLogin(){
        return redirect('/login');
    }
    public function login(){
        Session(['userName' => 'JUAN PABLO']);
        Session(['userLastName' => 'CABRERA ROCHA']);
        Session(['userId' => 1]);
        Session(['userRol' => 'administrador']);
        //Session::flush();
        return view('login');
        /*
        Session(['userName' => 'JUAN PABLO']);
        Session(['userRol' => 'administrador']);
        //Session::flush();
        if (Session::has('userName')) {
            return view("panel");
        }else{
            return view("login");
        }
            */
    } 
    public function home(){
        $id = auth()->user()->id;
        $materias_cursando = DB::table('sem_materiainscrita as mi')
            ->select('m.codigo', 'm.titulo','mi.gestion')
            ->leftJoin('sem_materia as m', 'mi.idmateria', '=', 'm.id')
            ->leftJoin('sem_materiahabilitada as mh', 'mi.idmateriahabilitada', '=', 'mh.id')
            ->where('mi.idestudiante', $id)
            ->where('mh.estado', 1)
            ->where('mi.estado', 'C')
            ->get();
        return view('panel',compact('materias_cursando'));
    } 
}
