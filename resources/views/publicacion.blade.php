@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
  <div id="menu">
    <h1>Panel de Publicaciónes</h1>
    <a href="#agregar">Añadir Publicación</a>
    <a href="#modificar">Modificar Publicación</a>
  </div><hr>
  <section id="agregar" name="Añadir Publicacion">
    <form action="" id="agregarPublicacion">
      <h3>Añadir una Publicación</h3>
      <input name="tipo" placeholder="Tipo de Publicación" type="text" id="tipo"><br>
      <input name="titulo" type="text" id="tipo" placeholder="Título"><br>
      <input name="volumen" type="text" id="volumen" placeholder="Volumen"><br>
      <input name="issue" type="text" id="issue" placeholder="Issue"><br>
      <input name="pages" type="text" id="pages" placeholder="Pages"><br>
      <input name="issn" type="text" id="issn" placeholder="Issn"><br>
      <input name="notas" type="text" id="notas" placeholder="Notas"><br>
      <input name="doi" type="text" id="doi" placeholder="Doi"><br>
      <input name="revista" type="text" id="revista" placeholder="Revista"><br>
      <input name="tipoRevista" type="text" id="tipoRevista" placeholder="Tipo de la revista"><br>
      <input name="publisher" type="text" id="publisher" placeholder="Publicador"><br>
      <textarea name="abstract" cols="150" rows="5" id="" cols="30" rows="10" placeholder="Insertar Abstract Aquí..." form="agregarPublicacion"></textarea><br>
      <a href="" class="btn btn-primary">Añadir Publicación</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Publicacion">
    <h3>Modificar Publicación</h3>

  </section>

@endsection