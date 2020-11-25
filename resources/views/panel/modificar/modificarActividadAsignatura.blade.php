@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')

<h1>Modificar actividad de asignatura</h1>
<hr>
<a class="btn btn-primary" href="{{ route('panelAdministracion') }}" role="button">Volver</a>
<input type="text" autofocus class="form-control" id="search" name="search" autocomplete="off">
<div class="p-2" id="sugerencias" name="sugerencias">

</div>
<script type="text/javascript">
  var ruta = "getAsignatura";
  var ruta2 = "modificarActividadAsignatura";
</script>
<script type="text/javascript" src="{{asset('js/select.js')}}"></script>

@endsection