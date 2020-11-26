@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')

<h1>Modificar actividad de área</h1>
<hr>
<input type="text" autofocus class="form-control" id="search" name="search" autocomplete="off" placeholder="Buscar">
<div class="p-2" id="sugerencias" name="sugerencias">

</div>
<script type="text/javascript">
  var ruta = "getArea";
  var ruta2 = "modificarActividadArea";
</script>
<script type="text/javascript" src="{{asset('js/select.js')}}"></script>

@endsection