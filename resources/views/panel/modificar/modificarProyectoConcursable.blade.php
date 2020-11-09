@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')

<h1>Modificar proyecto concursable</h1>
<hr>
<a class="btn btn-primary" href="{{ route('panelAdministracion') }}" role="button">Volver</a>
<input type="text" class="form-control" id="search" name="search" autocomplete="off">
<div class="p-2" id="sugerencias" name="sugerencias">

</div>
<script type="text/javascript">
  var ruta = "getProyectoConcursable";
  var ruta2 = "modificarProyectoConcursable";
</script>
<script type="text/javascript" src="{{asset('js/search.js')}}"></script>

@endsection