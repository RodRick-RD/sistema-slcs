@extends('layout.template')
@section('contenido')

<h1 class="m-0 p-3 text-center text-secondary">SEDES</h1>

<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nro</th>
                    <th scope="col">Nombre de la sede</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $correlativo=1; 
                ?> 
                @foreach ($sedes as $sede)
                    <tr>
                        <th scope="row">
                            <?php echo $correlativo; 
                            $correlativo++;?>
                        </th>
                        <td>{{ $sede->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection