@extends('layout.template')
@section('contenido')

<h1 class="m-0 p-3 text-center">ACTIVIDADES</h1>


<div class="row g-4">
    <div class="col-sm-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('successdelete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('successdelete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>

<div class="d-flex justify-content-between gap-2 align-items-center my-2">
    <a href="{{ route('tareas.materia') }}"><button class="btn btn-primary"><i class="fas fa-chevron-left mr-1"></i> Volver</button></a>
    <a href="{{ route('tareas.actividades.create',['id' => $materiaid]) }}"><button class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Agregar Actividad</button></a>
</div>

<div class="card">
    <div class="card-header">
    <h3 class="card-title">ACTIVIDADES REALIZADAS</h3>


    <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="table_search" id="buscador" class="form-control float-right" placeholder="Search">

        <div class="input-group-append">
            <button type="submit" class="btn btn-default">
            <i class="fas fa-search"></i>
            </button>
        </div>
        </div>
    </div>
    </div>
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap" id="tabla">
    <thead>
                <tr>
                    <th scope="col">Nro</th>
                    <th scope="col">TITULO</th>
                    <th scope="col">OPCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $correlativo=1; 
                ?> 
                @foreach ($tareas as $tarea)
                    <tr>
                        <th scope="row">
                            <?php echo $correlativo; 
                            $correlativo++;?>
                        </th>
                        <td>{{ $tarea->titulo }}</td>
                        <td>
                            <form action="{{ route('tareas.actividades.destroy', ['id' => $materiaid, 'actividade' => $tarea->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-circle mx-1" onclick="return confirm('¿Eliminar actividad?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>

<script>
    const buscador = document.getElementById('buscador');
    const filas = document.querySelectorAll('#tabla tbody tr');

    buscador.addEventListener('keyup', function() {
      const valor = this.value.toLowerCase();

      filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(valor) ? '' : 'none';
      });
    });
  </script>


@endsection