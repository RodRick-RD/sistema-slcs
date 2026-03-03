@extends('layout.template')
@section('contenido')


<div class="row">
  <div class="col-12 col-md-8 p-2">
    <div>
      <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('dist/img/slcs.webp') }}" width="80" height="auto" class="img-fluid" alt="User Image">  
      </div>
      <h1 class="p-1 h3 text-center text-navy font-weight-bold">SEMINARIO LIFE CENTER SOBRENATURAL</h1>
      <hr>
    </div>

   

    <div class="row">
      @forelse ($materias_cursando as $cursando)
          <div class="col-12 col-sm-6">
            <a href="{{ route('materias.mostrar',['codigo' => $cursando->codigo]) }}" class="text-reset text-decoration-none">
              <div class="info-box">
                <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-book"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text fw-bold text-navy text-wrap">{{ $cursando->titulo }}</span>
                  <span class="info-box-number">
                    <small class="text-secondary">{{ $cursando->gestion }}</small>
                  </span>
                </div>
              </div>
            </a>
          </div>
      @empty
      <div class="col-12 p-2"><p class="text-center">NO ESTÁS INSCRITO EN NINGUNA MATERIA EN ESTA GESTIÓN.</p></div>
      @endforelse
    </div>
          
  </div>
  <div class="col-12 col-md-4 p-2">
    <div class="card card-info">
      <div class="card-header bg-navy">
        <h3 class="card-title">NOTIFICACIONES</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="card">
          <div class="card-header border-0">
              <h4 class="text-center  m-0 mb-3"><b>"SLCS v1".</b></h4>
              <p>Sistema diseñado para dar un mejor servicio a los estudiantes de SLCS, con las siguientes caracteristicas:</p>
              <ul>
                <li>Autenticación de usuarios.</li>
                <li>Centralización de la información.</li>
                <li>Información del estado de la materia.</li>
                <li>Diseño responsivo.</li>
                <li>Material de apoyo.</li>
              </ul>
              <p class="font-weight-bold">El equipo de TI y COMUNICACIÓN</p>
          </div>
        </div>
      <!-- notificaciones -->
      </div>
    </div>
  </div>

</div>

@endsection
       
    
