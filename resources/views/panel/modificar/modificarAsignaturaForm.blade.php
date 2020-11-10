@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Asignatura">
  <h3>Modificar Asignatura</h3><br>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-asignatura">
    @csrf
    <div id="asignatura" class="form-group row">
        <label for="input-asignatura" class="col-sm-2 col-form-label">Asignatura</label>
        <div class="col-sm-10">
            <input class="form-control col-sm-5" autocomplete="off" name="nombre" placeholder="Nombre asignatura" type="text" id="asignatura-input" value="{{ $asignatura->nombre }}">
        </div>
      </div>
      <div id="subarea" class="form-group row">
        <label for="input-subarea" class="col-sm-2 col-form-label">Subárea</label>
        <div class="col-sm-10">
            <input class="form-control col-sm-5" autocomplete="off" name="subarea" placeholder="Nombre de subárea" type="text" id="subarea-input" value="{{ $subarea->nombre }}">
        </div>
      </div>
      <div id="codigo" class="form-group row">
        <label for="input-codigo" class="col-sm-2 col-form-label">Código</label>
        <div class="col-sm-10">
            <input class="form-control col-sm-5" autocomplete="off" name="codigo" placeholder="Código (Ej: CORE101)" type="text" id="codigo-input" value="{{ $asignatura->codigo }}">
        </div>
      </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-asignatura" value="Submit">Guardar</button>
    <input type="hidden" value="asignatura" name="modelo">
    <input type="hidden" name="id" value="{{ $asignatura->id }}">
  </form>
</section>
@endsection