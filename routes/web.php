<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControllerKardex;
use App\Http\Controllers\ControllerMateria;
use App\Http\Controllers\ControllerMiPerfil;
use App\Http\Controllers\ControllerUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[ControllerUser::class,'redirigirLogin'])->name('redirigir');
//Route::get('/login',[ControllerUser::class,'login'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('home', [ControllerUser::class,'home'])->name('inicio');
    Route::get('pensum-de-materias',[ControllerMateria::class,'pensumlista'])->name('pensum.lista');

    Route::get('kardex-estudiantil',[ControllerKardex::class,'lista'])->name('kardex.lista');

    Route::get('materia-habilitada/{codigo}',[ControllerMateria::class,'mostrarmateria'])->name('materias.mostrar');

    Route::get('mi-perfil', [ControllerMiPerfil::class,'miperfil'])->name('perfil.editar');
    Route::put('mi-perfil.reset-password', [ControllerMiPerfil::class,'reset'])->name('perfil.reset-password');

});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


