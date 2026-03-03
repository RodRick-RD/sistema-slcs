@extends('layout.template')
@section('contenido')

<h1 class="m-0 p-3 text-center">PENSUM DE MATERIAS</h1>
<div class="p-2">
    <a href="{{ route('inicio') }}"><button class="btn btn-info"><i class="fas fa-home mr-1"></i> Volver a INICIO</button></a>
</div>

<div class="card">
    <div class="card-header">
    <h3 class="card-title">Lista de Materias</h3>


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
                    <th scope="col">CÓDIGO</th>
                    <th scope="col">MATERIA</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $correlativo=1; 
                ?> 
                @foreach ($materias as $materia)
                    <tr>
                        <th scope="row">
                            <?php echo $correlativo; 
                            $correlativo++;?>
                        </th>
                        <td>{{ $materia->codigo }}</td>
                        <td>{{ $materia->titulo }}</td>
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