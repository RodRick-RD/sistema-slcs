@extends('layout.template')
@section('contenido')

<div class="p-2">
    <a href="{{ route('inicio') }}"><button class="btn btn-info"><i class="fas fa-home mr-1"></i> Volver a INICIO</button></a>
</div>
<h1 class="m-0 p-3 text-center">{{ $materia->titulo }}</h1>







<section class="">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <div class="time-label">
                <span class="bg-indigo">ACTIVIDADES</span>
              </div>
              
              @foreach ($tareas as $tarea)
                    @if($tarea->tipo=='video')
                        <div>
                            <i class="fas fa-video bg-danger"></i>

                            <div class="timeline-item">
                            <h3 class="timeline-header font-weight-bold p-2">{{ $tarea->titulo }}</h3>

                            <div class="timeline-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                {!! $tarea->contenido !!}
                                </div>
                            </div>
                            </div>
                        </div>
                    @elseif($tarea->tipo=='link')
                        <div>
                          <i class="fas fa-link bg-purple"></i>

                            <div class="timeline-item">
                            <h3 class="timeline-header font-weight-bold p-2">{{ $tarea->titulo }}</h3>

                            <div class="timeline-body">
                              <a href="{{$tarea->contenido }}" target="_blank"><button class="btn btn-link">{{$tarea->contenido }}</button></a>
                            </div>
                            </div>
                        </div>

                    @else
                        <div>
                            <i class="fas fa-file bg-secondary"></i>

                            <div class="timeline-item">
                            <h3 class="timeline-header font-weight-bold p-2">{{ $tarea->titulo }}</h3>

                            <div class="timeline-body">
                            {!! nl2br(e($tarea->contenido)) !!}
                            </div>
                            </div>
                        </div>
                    @endif

            @endforeach


              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>











@endsection