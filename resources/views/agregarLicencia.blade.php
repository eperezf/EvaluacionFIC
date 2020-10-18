@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Licencias</h1>
    <a href="#agregar">Agregar Licencia</a>
    <a href="#modificar">Modificar Licencia</a>
  </div><hr>
  <section id="agregar" name="Agregar Licencia">
    <h3>Agregar Licencia</h3>
    <form action="" id="agregarLicencia">
      <div id="licencia" class="form-group row">
        <label for="input-licencia" class="col-sm-1 col-form-label">Licencia</label>
        <div class="col-sm-10">
          <input name="nombre" class="form-control col-sm-5" placeholder="Nombre de la licencia" type="text" id="input-licencia">
        </div>
      </div>
      <div id="empresa" class="form-group row">
        <label for="input-empresa" class="col-sm-1 col-form-label">Empresa</label>
        <div class="col-sm-10">
          <input name="empresa" class="form-control col-sm-5" id="input-empresa" placeholder="Nombre de la empresa">
        </div>
      </div><br>
      <a href="" class="btn btn-primary">Agregar Licencia</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Licencia">
    <h3>Modificar Licencia</h3>
  </section>

@endsection