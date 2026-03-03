@extends('layout.sidebar')

@section('contenidoscript')
        
      @yield('contenido')

      
      </div>
    </div>
  </div>
  
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
</body>
</html>
@endsection
