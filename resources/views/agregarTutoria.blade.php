@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Tutorías</h1><hr>
<section id="agregar" name="Agregar Tutoria">
  <h3>Agregar una tutoría</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postTutoria') }}" id="agregar-tutoria">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-1 col-form-label">Tutoría</label>
      <div class="col-sm-10">
      <input name="tutoria" class="form-control col-sm-5" placeholder="Nombre de la tutoría" type="text" id="nombre-input" value="{{ old('tutoria') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-tutoria" value="Submit">Agregar tutoría</button>
  </form>
</section>
@endsection
