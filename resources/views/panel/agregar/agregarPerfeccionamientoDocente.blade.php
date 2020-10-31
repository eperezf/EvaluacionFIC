@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
<h1>Panel de Perfeccionamiento Docente</h1><hr>
<section id="agregar">
  <h3>Agregar un perfeccionamiento docente</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
  <form action="{{route('postPerfeccionamientoDocente')}}" method="POST" id="agregar-perfeccionamientodocente">
    @csrf
    <div id="perfeccionamiento" class="form-group row">
      <label for="input-perfeccionamiento" class="col-sm-3 col-form-label">Perfeccionamiento Docente</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-4" name="nombre" placeholder="Nombre del perfeccionamiento" type="text" id="input-perfeccionamiento" value="{{ old('nombre') }}">
      </div>
    </div>
    <div id="area" class="form-group row">
      <label for="select-area" class="col-sm-3 col-form-label">Área</label>
      <div class="col-sm-9">
        <select class="form-control col-sm-4" requiered="true" name="area" id="select-area">
          <option disabled value="Seleccione una asignatura" selected>Seleccione un área</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="institucion" class="form-group row">
      <label for="institucion-input" class="col-sm-3 col-form-label">Institución</label><br>
      <div class="col-sm-9">
      <input type="text" class="form-control col-sm-4" placeholder="Nombre de la institución" name="institucion" id="institucion-input" value="{{ old('institucion') }}">
      </div>
    </div><br>
    <button type="submit" form="agregar-perfeccionamientodocente" class="btn btn-primary">Guardar</button>
  </form>
</section>
@endsection