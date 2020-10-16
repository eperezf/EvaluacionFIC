@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Tipos de Actividad</h1>
    <a href="#agregar">Añadir Tipo de Actividad</a>
    <a href="#modificar">Modificar Tipo de Actividad</a>
  </div><hr>
  <section id="agregar" name="Añadir Tipo de Actividad">
    <h3>Añadir un Tipo de Actividad</h3>
    <form action="" id="agregarTipoActividad">
      <div id="tipoactividad" class="form-group row">
        <label for="input-tipoactividad" class="col-sm-2 col-form-label">Tipo de actividad</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-5" type="text" placeholder="Tipo de Actividad" name="tipo" id="input-tipoactividad">
        </div>
      </div><br>
      <a href="" class="btn btn-primary">Añadir Tipo de Actividad</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Tipo de Actividad">
    <h3>Modificar un Tipo de Actividad</h3>
  </section>

@endsection
