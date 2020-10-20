@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Asignaturas</h1><hr>
<section id="agregar" name="Agregar Asignatura">
  <h3>Agregar una Asignatura</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postAsignatura') }}" id="agregar-asignatura">
    @csrf
    <div id="asignatura" class="form-group row">
      <label for="input-asignatura" class="col-sm-2 col-form-label">Asignatura</label>
      <div class="col-sm-10">
        <input name="asignatura" class="form-control col-sm-5" placeholder="Nombre Asignatura" type="text" id="input-asignatura" value="{{ old('asignatura') }}">
      </div>
    </div>
    <div id="codigo" class="form-group row">
      <label for="input-codigo" class="col-sm-2 col-form-label">Código</label>
      <div class="col-sm-10">
        <input name="codigo" class="form-control col-sm-5" placeholder="Código (Ej. CORE101)" type="text" id="input-codigo" value="{{ old('codigo') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" value="Submit" form="agregar-asignatura">Agregar asignatura</button>
  </form>
</section>

@endsection
