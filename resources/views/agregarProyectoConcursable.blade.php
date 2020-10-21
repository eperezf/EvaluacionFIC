@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Proyectos Consursables</h1><hr>
<section id="agregar" name="Agregar ProyectoConcursable">
  <h3>Agregar un proyecto concursable</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postProyectoConcursable') }}" id="agregar-proyectoconcursable">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-1 col-form-label">Proyecto</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" name="proyectoConcursable" placeholder="Nombre del proyecto concursable" type="text" id="nombre-input" value="{{ old('proyectoConcursable') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-proyectoconcursable" value="Submit">Agregar proyecto concursable</button>
  </form>
</section>
@endsection