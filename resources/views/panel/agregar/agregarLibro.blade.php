@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
<h1>Panel de Libros</h1><hr>
<section id="agregar" name="Agregar Libro">
  <h3>Agregar un libro</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postLibro') }}" id="agregar-libro">
    @csrf
    <div id="titulo" class="form-group row">
      <label for="titulo-input" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="titulo" type="text" id="titulo-input" placeholder="Título del libro" value="{{ old('titulo') }}"">
      </div>
    </div>
    <div id="isbn" class="form-group row">
      <label for="isbn-input" class="col-sm-2 col-form-label">Isbn</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="isbn" type="text" id="isbn-input" placeholder="isbn" value="{{ old('isbn') }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-libro" value="Submit">Guardar</button>
  </form>
</section>
@endsection
