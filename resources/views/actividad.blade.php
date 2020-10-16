@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Actividades</h1>
  <a href="#agregar">Añadir Actividad</a>
  <a href="#modificar">Modificar Actividad</a>
</div><hr>
<section id="agregar" name="Añadir Actividad">
  <h3>Añadir una Actividad</h3>
  <form action="" id="agregarActividad">
    <div id="tipoactividad" class="form-group row">
      <label for="select-tipoactividad" class="col-sm-2 col-form-label">Tipo de actividad</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" name="tipoactividad" id="select-tipoactividad">
          <option selected disabled value="Seleccione un tipo de Actividad">Seleccione un tipo de Actividad</option>
          @foreach($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="inicio" id="input-inicio">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="termino" id="input-termino">
      </div>
    </div><br>
    <a href="" class="btn btn-primary">Añadir Actividad</a><br>
  </form>
</section><hr>
<section id="modificar" name="Modificar Actividad">
  <h3>Modificar Actividad</h3>

</section>

@endsection
