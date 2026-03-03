<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\MateriasInscritas;
use App\Models\Pago;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerEstudiante extends Controller
{
    public function estudiantelista(){
        
        $this->SinEstudiante();

        $rol = auth()->user()->rol;
        $sede = auth()->user()->sedes_id;
        if ($rol === 'administrador') {
            $estudiantes = DB::table('users')->join('sedes', 'users.sedes_id', '=', 'sedes.id')
                ->select('users.*', 'sedes.nombre as nombre_sede')
                ->where('users.estado', true)->get();

            return view('estudiantes.lista',compact('estudiantes'));

        }elseif($rol === 'supervisor'){

            $estudiantes = DB::table('users')->join('sedes', 'users.sedes_id', '=', 'sedes.id')
                    ->select('users.*', 'sedes.nombre as nombre_sede') 
                    ->where('users.estado', true)
                    ->where('users.sedes_id', $sede)
                    ->get();

            return view('estudiantes.lista',compact('estudiantes'));
        }
        
        abort(403, 'Rol no autorizado.');
        
    }


    public function create(){
        
        $rol = auth()->user()->rol;
        $sede = auth()->user()->sedes_id;
        if ($rol === 'administrador') {
            $sedes= Sede::all();
            return view('estudiantes.formnuevo',compact('sedes'));

        }elseif($rol === 'supervisor'){
            $sedes= Sede::where('id',$sede)->where('estado',true)->get();
            return view('estudiantes.formnuevo',compact('sedes'));
        }
        
        abort(403, 'Rol no autorizado.');
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            //'img' => 'image|mimes:webp|max:1024',
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'celular' => 'required|unique:users,celular|string|max:20',
            'ci' => 'required|string|max:30|unique:users,ci',
            'correo' => 'max:40',
            'password' => 'required|string|min:6',
            'sedes_id' => 'required|exists:sedes,id',
        ]);

        User::create([
            'img' => 'default',
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'ci' => $request->ci,
            'correo' => $request->correo,
            'password' => password_hash($request->password, PASSWORD_DEFAULT, ['cost'=>10]),
            'rol' => 'estudiante',
            'estado' => true,
            'sedes_id' => $request->sedes_id, // Asegúrate que esta sede exista
            'id_persona' => 0,
        ]);

        return redirect()->route('estudiante.lista')->with('success', 'Usuario creado correctamente');
    }


    /*  ------------------------- */
    public function materialista($id){

        $estudiante=User::findOrFail($id);


        $materias = DB::table('materias_inscritas as mi')
            ->select(
                'g.gestion',
                'm.titulo',
                'mi.tp',
                'mi.ex',
                'mi.ad',
                DB::raw('(mi.tp + mi.ex + mi.ad) as NOTA'),
                'mi.me',
                'mi.estado'
            )
            ->leftJoin('materias as m', 'mi.materia_id', '=', 'm.id')
            ->leftJoin('gestion as g', 'mi.gestion_id', '=', 'g.id')
            ->where('mi.users_id', $id)
            ->whereNotIn('mi.estado', [4])
            ->orderByDesc('g.id')
            ->get();
                    
            return view('estudiantes.materialista',compact('materias','estudiante'));

        abort(403, 'Rol no autorizado.');   
    }
    public function materiaagregar($id){

        $estudiante=User::findOrFail($id);
        $gestiones=Gestion::where('estado',1)
            ->orderByDesc('id')
            ->get();

        $materias = DB::table('materias as m')
            ->select('m.id', 'm.codigo', 'm.titulo')
            ->where('m.estado', 1)
            ->where('sem', 1)
            ->whereNotIn('m.id', function ($query)use ($id) {
                $query->select('materia_id')
                    ->from('materias_inscritas')
                    ->where('users_id', $id)
                    ->whereIn('estado', [1, 2]);
            })
            ->get();

                    
        return view('estudiantes.agregarmateria',compact('estudiante','gestiones','materias'));

        abort(403, 'Rol no autorizado.');
    }

    public function materiaguardarbd(Request $request, $id){
        $request->validate([ 
            'gestion_id' => 'required',
            'materia_id' => 'required',
            'precio' => 'required|numeric|min:0',
            'cancelado' => 'required|numeric|min:0',
        ],[
            'gestion_id.required' => 'La Gestión es requerida',
            'materia_id.required' => 'La Materia es requerida',
            'precio.required' => 'el precio es requerido',
            'precio.min' => 'el precio debe ser igual o mayor a 0.',
            'cancelado.required' => 'el precio es requerido',
            'cancelado.min' => 'el precio debe ser igual o mayor a 0.',
        ]
        ); 
        DB::beginTransaction();
        $iduser = auth()->user()->id;
        try {
            $materiaInscrita = MateriasInscritas::create([
                'gestion_id' => $request['gestion_id'],
                'materia_id' => $request['materia_id'],
                'users_id' => $id,
                'tp' => 0,
                'ex' => 0,
                'ad' => 0,
                'me' => 0,
                'nf' => 0,
                'estado' => 'cursando',
                'editor_id' => $iduser,
            ]);

            // 2. Insertamos en pagos, relacionándolo con materias_inscritas
            Pago::create([
                'users_id' => $id,
                'tipo' => 'materia',
                'materias_inscritas_id' => $materiaInscrita->id,
                'debe' => $request['cancelado'],
                'haber' => $request['precio'],
                'editor_id' => $iduser,
            ]);

            DB::commit();

            return redirect()->to("/estudiante-materias/{$id}")->with('success', 'Materia inscrita y pago registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->to("/estudiante-materias/{$id}")->with('error','Error al guardar los datos: ' . $e->getMessage());
        }
 
        //return redirect()->to('/estudiantes/{$id}')->with('success', 'Materia agregada correctamente.'); 
    }

    public function estudianteeditar($id){
        
        $estudiante = User::findOrFail($id);
        if(auth()->user()->rol=='supervisor'){
            if($estudiante->rol==='supervisor' || $estudiante->rol==='administrador'){
                abort(403,'permiso denegado para este usuario');
            }
        }

        $imagePath = storage_path('app/users_photos/' . $estudiante->img.'.webp');
        $imageData = null;

        if (file_exists($imagePath)) {
            $fileContent = file_get_contents($imagePath);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $imagePath);
            finfo_close($finfo);

            $base64 = base64_encode($fileContent);
            $imageData = "data:$mime;base64,$base64";
        }
        return view('estudiantes.editar', compact('estudiante','imageData'));
    }


    public function actualizarInfoEstudiante(Request $request, $id) 
    { 
        $request->validate([
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
        ]);
 
        $estudiante = User::findOrFail($id); 
        $estudiante->update($request->all()); 
 
        return redirect()->to('/estudiantes')->with('successeditinfo', 'Informacion del estudiante actualizada correctamente.'); 
    }
    public function actualizarfotoEstudiante(Request $request, $id) 
    { 
        $request->validate([
            'img' => 'image|required|mimes:webp|max:1024',
        ],[
            'img.image'=>'debe ser tipo imagen.',
            'img.required'=>'la imagen es requerida.',
            'img.mimes'=>'la imagen debe ser de formato ".webp".',
            'img.max'=>'la imagen no debe ser mayor a 1 MB.',
        ]
    );
        $estudiante = User::findOrFail($id);
        $iduser=auth()->user()->id;

        $mombreImg='default';
        if($estudiante->img==='default'){
            $mombreImg = now()->setTimezone('America/Caracas')->format('Ymd').'-'.$iduser;
        }else{
            $mombreImg=$estudiante->img;
        }

        $archivo = $request->file('img');
        $ruta = storage_path('app/users_photos/');

        if (!file_exists($ruta)) {
            mkdir($ruta, 0755, true);
        }

        $archivo->move($ruta, $mombreImg.'.webp');

        $estudiante->img = $mombreImg;
        $estudiante->save();
 
        return redirect()->to('/estudiantes')->with('successeditinfo', 'La foto del estudiante fue actualizado correctamente.'); 
    }


    public function actualizarContraEstudiante(Request $request, $id) 
    { 
        $request->validate([
            'password' => 'required|string|min:6',
        ],[
            'password.required'=>'la contraseña es requerida.',
            'password.string'=>'Debe ser de tipo texto.',
            'password.nim'=>'la contrseña debe tener mínimo 6 carácteres.',
        ]);
 
        $estudiante = User::findOrFail($id); 
        $estudiante->password = password_hash($request->password, PASSWORD_DEFAULT, ['cost'=>10]);
        $estudiante->save();
 
        return redirect()->to('/estudiantes')->with('successeditinfo', 'La contraseña del estudiante fue cambiada.'); 
    }
}
