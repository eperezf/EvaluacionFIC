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
      <label for="titulo-input" class="col-sm-1 col-form-label">Título</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="libro" type="text" id="titulo-input" placeholder="Título del libro" value="{{ old('libro') }}"">
      </div>
    </div>
    <div id="isbn" class="form-group row">
      <label for="isbn-input" class="col-sm-1 col-form-label">Isbn</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="isbn" type="text" id="isbn-input" placeholder="isbn" value="{{ old('isbn') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-libro" value="Submit">Agregar libro</button>
  </form>
</section>
@endsection
