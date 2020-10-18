@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Perfeccionamiento Docente</h1>
    <a href="#agregar">Agregar Perfeccionamiento Docente</a>
    <a href="#modificar">Modificar Perfeccionamiento Docente</a>
  </div><hr>
  <section id="agregar">
    <h3>Agregar Perfeccionamiento Docente</h3>
    <form action="" id="agregar-perfeccionamientodocente">
        <div id="perfeccionamientodocente" class="form-group row">
          <label for="perfeccionamientodocente-input" class="col-sm-2 col-form-label">Perfeccionamiento Docente</label>
          <div class="col-sm-10">
            <input class="form-control col-sm-5" name="perfeccionamientodocente" placeholder="Nombre del Perfeccionamiento" type="text" id="perfeccionamientodocente-input">
          </div>
        </div>
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
            <div id="institucion" class="form-group row">
                <label for="input-institucion" class="col-sm-1 col-form-label">Institución</label><br>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-sm-5" placeholder="Nombre de Institucion" name="institucion" id="input-institucion">
                </div>
            </div><br>
            <a href="#" class="btn btn-primary">Agregar Perfeccionamiento Docente</a>
        </form>
    </section><hr>
    <section id="modificar">
        <h3>Modificar Perfeccionamiento Docente</h3>
    </section>

@endsection