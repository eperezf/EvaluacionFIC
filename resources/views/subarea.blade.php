@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Subareas</h1>
    <a href="#agregar">Añadir Subarea</a>
    <a href="#modificar">Modificar Subarea</a>
  </div><hr>
  <div id="agregar">
    <section id="agregar-subarea">
      <h3>Añadir Subarea</h3>
      <form action="">
        <div id="area" class="form-group row">
          <label for="select-area" class="col-sm-1 col-form-label">Area</label>
          <div class="col-sm-10">
            <select class="form-control col-sm-5" requiered="true" name="area" id="select-area">
              <option disabled value="Seleccione una asignatura" selected>Seleccione una area</option>
              @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div id="subarea" class="form-group row">
          <label for="subarea" class="col-sm-1 col-form-label">Subarea</label><br>
          <div class="col-sm-10">
            <input type="text" class="form-control col-sm-5" placeholder="Subarea" name="seccion" id="seccion">
          </div>
        </div>
        <a href="#" class="btn btn-primary">Añadir</a>
      </form>
    </section>
  </div><hr>
  <div id="modificar">
    <section id="modificar-subarea">
      <h3>Modificar Subarea</h3>
      <form action="">
        
      </form>
    </section>
  </div>

  
@endsection