@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')



<h1>Modificar área</h1>
<hr>
<a class="btn btn-primary" href="{{ route('panelAdministracion') }}" role="button">Volver</a>
<input type="text" class="form-control" id="search" name="search" autocomplete="off">
<div class="" id="sugerencias" name="sugerencias">

</div>
<script type="text/javascript">
  var ruta = "getAreas";
</script>
<script type="text/javascript" src="{{asset('js/search.js')}}"></script>

@endsection
