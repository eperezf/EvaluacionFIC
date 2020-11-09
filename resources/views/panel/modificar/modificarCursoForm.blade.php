@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Curso">
  <h3>Modificar Curso</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
  <form action="{{route('postModificar')}}" method="POST" id="modificar-curso">
    @csrf
    <div id="asignatura" class="form-group row">
      <label for="select-asignatura" class="col-sm-2 col-form-label">Asignatura</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" required="true" name="asignatura" id="select-asignatura">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una asignatura</option>
          @foreach($asignaturas as $asignatura)
            <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="seccion" class="form-group row">
      <label for="input-seccion" class="col-sm-2 col-form-label">Sección</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="seccion" placeholder="Nº de sección" type="text" id="seccion-input" value="{{ $curso->seccion }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $curso-> }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $curso-> }}">
      </div>
    </div><br>
    <button type="submit" form="modificar-curso" class="btn btn-primary">Guardar</button>
    <input type="hidden" name="modelo" value="curso">
    <input type="hidden" name="id" value="{{ $curso->id }}">
  </form>
</section>
@endsection