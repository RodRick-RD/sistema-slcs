<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'celular' => 'required|digits_between:8,15',
            'password' => 'required',
        ],
        [
            'celular.required'=> 'el celular es requerido',
            'password.required'=> 'la contraseña es requerida',
        ]
    );

        $user = User::where('celular', $request->celular)->where('estado', true)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/home');
        }
        return back()->withErrors([
            'celular' => 'Las credenciales no son válidas.',
            'denegado' => 'Credenciales inválidas o usuario deshabilitado.',
        ])->withInput($request->only('celular'));
    }

    public function dashboard()
    {
        return view('panel');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
