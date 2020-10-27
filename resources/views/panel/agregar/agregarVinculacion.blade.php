@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Vinculación con el Medio</h1><hr>
<section id="agregar" name="Agregar Vinculación">
  <h3>Agregar una vinculación</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postVinculacion') }}" id="agregar-vinculacion">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-2 col-form-label">Vinculación</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="vinculacion" placeholder="Nombre de la vinculación" type="text" id="nombre-input" value="{{ old('vinculacion') }}">
      </div>
    </div>
      <label for="descripcion-input" class="col-form-label">Descripción</label>
      <textarea class="form-control" name="descripcion" cols="150" rows="2" id="descripcion-input" cols="30" rows="10" placeholder="Insertar descripción aquí..." form="agregarVinculacion"></textarea><br>
      <button class="btn btn-primary" type="submit" form="agregar-vinculacion" value="Submit">Agregar vinculación</button>
  </form>
</section>
@endsection