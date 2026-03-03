<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerMiPerfil extends Controller
{
    public function miperfil(){
        $id=auth()->user()->id;
        $estudiante = User::findOrFail($id);
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
        return view('perfil.editar', compact('estudiante','imageData'));
    }
    
    public function reset(Request $request){
        $request->validate([
            'password' => 'required|string|min:6',
        ],[
            'password.required'=>'la contraseña es requerida.',
            'password.string'=>'Debe ser de tipo texto.',
            'password.nim'=>'la contrseña debe tener mínimo 6 carácteres.',
        ]);
        $id=auth()->user()->id;
        $estudiante = User::findOrFail($id); 
        $estudiante->password = password_hash($request->password, PASSWORD_DEFAULT, ['cost'=>10]);
        $estudiante->save();
        return redirect()->route('perfil.editar')->with('successcontra', 'La contraseña tu contraseña fue cambiada.'); 
    }
}
