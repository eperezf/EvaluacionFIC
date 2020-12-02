@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Area">
  <h3>Modificar Área</h3><br>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-area">
    @csrf
    <div id="area" class="form-group row">
      <label for="area-input" class="col-sm-1 col-form-label">Área</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="nombre" placeholder="Nombre área" type="text" id="area-input" value="{{ $area->nombre }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-area" value="Submit">Modificar área</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="area" name="modelo">
    <input type="hidden" value="{{ $area->id }}" name="id">
  </form>
</section>
@endsection