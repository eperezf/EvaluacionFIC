@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
  <div id="menu">
    <h1>Panel de Libros</h1>
    <a href="#agregar">Agregar Libro</a>
    <a href="#modificar">Modificar Libro</a>
  </div><hr>
  <section id="agregar" name="Agregar Libro">
    <h3>Agregar un Libro</h3>
    <form action="" id="agregarLibro">
      <div id="titulo" class="form-group row">
        <label for="input-titulo" class="col-sm-1 col-form-label">Título</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" name="titulo" type="text" id="input-tipo" placeholder="Título de libro">
        </div>
      </div>
      <div id="isbn" class="form-group row">
        <label for="input-isbn" class="col-sm-1 col-form-label">Isbn</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" name="isbn" type="text" id="input-isbn" placeholder="isbn">
        </div>
      </div>
      <a href="" class="btn btn-primary">Agregar Libro</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Libro">
    <h3>Modificar Libro</h3>
  </section>

@endsection
