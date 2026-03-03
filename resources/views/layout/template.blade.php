@extends('layout.sidebar')

@section('contenidoscript')
        
      @yield('contenido')

      
      </div>
    </div>
  </div>
  
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
$(function () {
  $('#compose-textarea').summernote({
    callbacks: {
      onImageUpload: function(files) {
        // Evita carga por arrastre o selección de archivo
        alert('Subir imágenes está deshabilitado.');
      },
      onPaste: function(e) {
        let clipboardData = e.originalEvent.clipboardData;
        if (clipboardData && clipboardData.items) {
          for (let i = 0; i < clipboardData.items.length; i++) {
            if (clipboardData.items[i].type.indexOf("image") !== -1) {
              e.preventDefault();
              alert('Pegar imágenes no está permitido.');
              return;
            }
          }
        }
      }
    }
  })
})
</script>
</body>
</html>
@endsection
