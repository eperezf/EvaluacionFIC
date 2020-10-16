@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Subareas</h1>
    <a href="#agregar">Añadir Subarea</a>
    <a href="#modificar">Modificar Subarea</a>
  </div><hr>
  <section id="agregar">
    <h3>Añadir Subarea</h3>
    <form action="">
      <div id="area" class="form-group row">
        <label for="select-area" class="col-sm-1 col-form-label">Área</label>
        <div class="col-sm-10">
          <select class="form-control col-sm-5" requiered="true" name="area" id="select-area">
            <option disabled value="Seleccione una asignatura" selected>Seleccione una área</option>
            @foreach ($areas as $area)
              <option value="{{ $area->id }}">{{ $area->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div id="subarea" class="form-group row">
        <label for="input-subarea" class="col-sm-1 col-form-label">Subarea</label><br>
        <div class="col-sm-10">
          <input type="text" class="form-control col-sm-5" placeholder="Subarea" name="subarea" id="input-subarea">
        </div>
      </div><br>
      <a href="#" class="btn btn-primary">Añadir subarea</a>
    </form>
  </section><hr>
  <section id="modificar">
    <h3>Modificar Subarea</h3>
  </section>

@endsection
