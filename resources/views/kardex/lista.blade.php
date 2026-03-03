@extends('layout.template')
@section('contenido')

<h1 class="m-0 p-3 text-center text-secondary">KARDEX ESTUDIANTIL</h1>

<div class="p-2">
    <a href="{{ route('inicio') }}"><button class="btn btn-info"><i class="fas fa-home mr-1"></i> Volver a INICIO</button></a>
</div>

<div class="card">
  <div class="card-body">
    <p class="m-0 p-0"><b>Estudiante: </b>{{ $estudiante->nombres}} {{ $estudiante->apellidos}}</p>
  </div>
</div>

<div class="card">
    <div class="card-header">
    <h3 class="card-title">Materias inscritas</h3>


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
                <th scope="col">Gestion</th>
                <th scope="col">Título</th>
                <th scope="col">MO</th>
                <th scope="col">TP</th>
                <th scope="col">EX</th>
                <th scope="col">NA</th>
                <th scope="col">NF</th>
                <th scope="col">estado</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $correlativo=1; 
            ?> 
            @forelse ($materias as $materia)
                <tr>
                    <th scope="row">
                        <?php echo $correlativo; 
                        $correlativo++;?>
                    </th>
                    <td>{{ $materia->gestion }}</td>
                    <td>{{ $materia->titulo }}</td>
                    <td>{{ $materia->modalidad }}</td>
                    <td>{{ $materia->t1 }}</td>
                    <td>{{ $materia->p1 }}</td>
                    <td>{{ $materia->n1 }}</td>
                    <td style="background-color: #e2e2e2;">{{ $materia->NOTA }}</td>
                    <td>{{ $materia->estado }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No esta inscrito a ninguna materia.</td>
                </tr>
                @endforelse
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