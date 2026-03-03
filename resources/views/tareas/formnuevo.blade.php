@extends('layout.template')
@section('contenido')

<h1 class="m-0 p-3 text-center text-secondary">TAREAS</h1>



<div class="d-flex align-items-center my-2">
    <a href="{{ route('tareas.actividades.index',['id' => $materiaid]) }}"><button class="btn btn-primary"><i class="fas fa-chevron-left mr-1"></i> Volver</button></a>
</div>


<form action="{{ route('tareas.actividades.store',['id' => $materiaid]) }}" method="POST">
    @csrf
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Nueva actividad</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                    <label>Título</label>
                  <input class="form-control" placeholder="Titulo" name="titulo">
                  @error('titulo')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Contenido</label>
                    <textarea id="compose-textarea" class="form-control" name="contenido" style="height: 300px;">
                      
                    </textarea>
                </div>
                @error('contenido')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 form-group px-3">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
            </div>
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>

</form>
@endsection
