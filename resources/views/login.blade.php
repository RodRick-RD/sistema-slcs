<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SLCS - LOGIN</title>
  <link rel="shortcut icon" href="{{ asset('dist/img/slcs.webp') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f2f5;
    }
    .login-container {
        width: 100%;
      max-width: 400px;
      background: #fff;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }
    .login-title {
      font-weight: bold;
      margin-bottom: 1rem;
    }
    .bg-navy{
      background-color: #002255;
    }
    .bg-navy:hover{
      background-color: #0d3c82;
      transform: 0.3s;
    }
  </style>
</head>
<body>

  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="login-container">
        
        <h3 class="text-center login-title m-0 p-0">SLCS</h3>
        <h5 class="text-center login-title text-body-tertiary">Iniciar Sesión</h5>
        
      <form method="POST" action="/login">
      @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Usuario</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" placeholder="Celular" value="{{ old('celular') }}">
            @error('celular')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="d-grid">
          <button type="submit" class="btn btn-dark bg-navy"><i class="fas fa-sign-in-alt px-1"></i> Ingresar</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>

  </script>
</body>
</html>
