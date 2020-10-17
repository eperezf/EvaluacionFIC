@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Cargos Administrativos</h1>
    <a href="#agregar">Agregar Cargo</a>
    <a href="#modificar">Modificar Cargo</a>
  </div><hr>
  <section id="agregar" name="Agregar Cargo">
    <h3>Agregar Cargo</h3>
    <form action="" id="agregarCargo">
      <div id="cargo" class="form-group row">
        <label for="input-cargo" class="col-sm-1 col-form-label">Cargo</label>
        <div class="col-sm-10">
          <input name="nombre" class="form-control col-sm-5" placeholder="Nombre del Cargo" type="text" id="input-cargo">
        </div>
      </div>
      <div id="peso" class="form-group row">
        <label for="input-peso" class="col-sm-1 col-form-label">Peso</label>
        <div class="col-sm-10">
          <input name="peso" class="form-control col-sm-1" type="number" id="input-peso" placeholder="Peso">
        </div>
      </div><br>
      <a href="" class="btn btn-primary">Agregar Cargo</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Cargo">
    <h3>Modificar Cargo</h3>
  </section>

@endsection
