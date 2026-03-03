@extends('layout.template')
@section('contenido')

<h1 class="m-0 p-3 text-center text-secondary">MI PERFIL</h1>


<div class="p-2">
    <a href="{{ route('inicio') }}"><button class="btn btn-info"><i class="fas fa-home mr-1"></i> Volver a INICIO</button></a>
</div>

<div class="row g-4">
    <div class="col-sm-12">
        @if(session('successcontra'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successcontra') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>


<div class="card card-primary card-outline">
    <div class="card-header">
    <h5 class="card-title m-0 font-weight-bold text-navy">DATOS PERSONALES</h5>
    </div>
    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="exampleInputFile">Foto del estudiante</label>
                    <div class="p-2">
                        <img src="{{ $imageData }}" alt="user" width="200px" class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control" value="{{ $estudiante->nombres }}" name="nombres" disabled>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" value="{{ $estudiante->apellidos }}" name="apellidos" disabled>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label>Celular</label>
                    <input type="text" class="form-control" value="{{ $estudiante->celular }}" name="celular" disabled>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label>Cédula de identidad</label>
                    <input type="text" class="form-control" value="{{ $estudiante->ci }}" name="ci" disabled>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label>Correo electrónico</label>
                    <input type="email" class="form-control" name="correo" value="{{ $estudiante->correo }}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card p-4 bg-dark">
<form action="{{ route('perfil.reset-password') }}" method="POST">
    @csrf
    @method('PUT') 
    <div class="row">
        <div class="col-12 col-md-6 form-group">
            <label>Cambiar Contraseña</label>
                <input type="password" class="form-control" name="password" id="password">
                <!-- <button class="btn btn-info btn-sm rounded-pill m-1" onclick="generarContrasena();" type="button">Generar contraseña segura</button> -->
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="col-12 form-group d-flex justify-content-center">
            <button type="submit" class="btn btn-light btn-lg rounded-pill"><i class="fas fa-user-edit mr-2"></i>Restablecer Contraseña</button>
        </div>
    </div>
</form>
</div>


<script>
    function generarContrasena() {
    const longitud = 12;
    const mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const minusculas = 'abcdefghijklmnopqrstuvwxyz';
    const numeros = '0123456789';
    const simbolos = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    const todos = mayusculas + minusculas + numeros + simbolos;

    let contrasena = '';
    // Garantiza al menos un carácter de cada tipo
    contrasena += mayusculas[Math.floor(Math.random() * mayusculas.length)];
    contrasena += minusculas[Math.floor(Math.random() * minusculas.length)];
    contrasena += numeros[Math.floor(Math.random() * numeros.length)];
    contrasena += simbolos[Math.floor(Math.random() * simbolos.length)];

    for (let i = contrasena.length; i < longitud; i++) {
        contrasena += todos[Math.floor(Math.random() * todos.length)];
    }
    contrasena = contrasena.split('').sort(() => 0.5 - Math.random()).join('');

    $("#password").val(contrasena);
}
</script>

@endsection
