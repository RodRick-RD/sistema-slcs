<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SLCS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('dist/img/slcs.webp') }}" type="image/x-icon">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>

    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
      {{ auth()->user()->nombres }}
      </button>
      <div class="dropdown-menu m-0">
        <div class="p-3 bg-secondary d-flex flex-column align-items-center text-center">
          <img src="{{ asset('dist/img/user.webp') }}" width="60" height="auto" class="img-circle elevation-2 mx-2 my-3" alt="User Image">  
          <span class="fw-bold">{{ auth()->user()->nombres }} {{ auth()->user()->apellidos }}</span>
          <span>{{ auth()->user()->rol }}</span>
        </div>
        <div class="pt-3 px-3 d-flex justify-content-between gap-3">
          <a class="dropdown-item" href="{{ route('perfil.editar')}}">Mi Perfil</a>

          <a class="dropdown-item" href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary">
    <div class="brand-link border-bottom mb-2">
      <img src="{{ asset('dist/img/slcs.webp') }}" alt="SLCS" class="brand-image img-circle" style="opacity: .8">
      <p class="brand-text fw-bold">SLCS</p>
    </div>
    <div class="sidebar">
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <nav class="mt-2">
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('inicio') }}" class="nav-link">
              <i class="fas fa-home"></i>
              <p class="ml-2">
                INICIO
              </p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-swatchbook"></i>
              <p class="ml-2">
                ACADÉMICO
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('kardex.lista') }}" class="nav-link">
                  <i class="fas fa-book"></i>
                  <p class="ml-2">KARDEX ESTUDIANTIL</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pensum.lista') }}" class="nav-link">
                  <i class="fas fa-th-list"></i>
                  <p class="ml-2">PENSUM DE MATERIAS</p>
                </a>
              </li>
            </ul>
          </li>
          


          <li class="nav-item mt-4">
            <a href="#" class="nav-link bg-white" 
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <p>Cerrar Sesión</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        </ul>
      </nav>
    </div>
  </aside>



  <div class="content-wrapper">
    
    <div class="content">
      <div class="container-fluid">
        
      @yield('contenidoscript')
