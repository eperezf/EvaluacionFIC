@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')

<h1>Lista de actividades</h1>
<hr>
<a class="btn btn-primary" href="{{ route('modificarActividadAsignatura') }}" role="button">Volver</a>
<input type="text" autofocus name="search" id="search" class="form-control" autocomplete="off">
<div class="p-2" id="sugerencias" name="sugerencias">

</div>

<script type="text/javascript">
  var ruta = "getUser";
  var ruta2 = "modificarAsignatura";
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js' )}}"></script>

@endsection