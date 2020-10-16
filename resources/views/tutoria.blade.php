@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Tutorías</h1>
    <a href="#agregar">Añadir Tutoría</a>
    <a href="#modificar">Modificar Tutoría</a>
  </div><hr>
  <section id="agregar" name="Añadir Tutoria">
    <h3>Añadir una Tutoría</h3>
    <form action="" id="agregarTutoria">
      <div id="tutoria" class="form-group row">
        <label for="input-tutoria" class="col-sm-1 col-form-label">Tutoría</label>
        <div class="col-sm-10">
          <input name="nombre" class="form-control col-sm-5" placeholder="Nombre de la Tutoría" type="text" id="input-tutoria">
        </div>
      </div><br>
      <a href="" class="btn btn-primary">Añadir Tutoría</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Tutoria">
    <h3>Modificar Tutoría</h3>
  </section>

@endsection
