@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')

<h1>Modificar área</h1>
<hr>
<input type="text" class="form-control" id="search" name="search" autocomplete="off" placeholder="Buscar">
<div class="p-2" id="sugerencias" name="sugerencias">

</div>
<script type="text/javascript">
  var ruta = "getAreas";
  var ruta2 = "modificarArea";
</script>
<script type="text/javascript" src="{{asset('js/search.js')}}"></script>

@endsection
