@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Áreas</h1><hr>
<section id="agregar" name="Agregar Area">
  <h3>Agregar una Área</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postAgregar') }}" id="agregar-area">
    @csrf
    <div id="area" class="form-group row">
      <label for="area-input" class="col-sm-1 col-form-label">Área</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="nombre" placeholder="Nombre área" type="text" id="area-input" value="{{ old('nombre') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-area" value="Submit">Agregar área</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="area" name="modelo">
  </form>
</section>

@endsection
