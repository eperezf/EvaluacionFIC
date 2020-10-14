@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Cursos</h1>
    <a href="#agregar">Añadir Curso</a>
    <a href="#modificar">Modificar Curso</a>
  </div><hr>
  <section id="agregar" name="Añadir Curso">
    <form action="" id="agregarCurso">
      <h3>Añadir una Curso</h3>
      <select required="true" name="Asignatura" id="asignatura">
        <option disabled value="Seleccione una asignatura" selected>Seleccione una asignatura</option>
        @foreach($asignaturas as $asignatura)
          <option value="{{$asignatura->id}}">{{$asignatura->nombre}}</option>
        @endforeach
      </select><br>
      <label for="seccion">Sección.</label><br>
      <input type="number" placeholder="Sección" name="seccion" id="seccion"><br>
      <label for="calificacion">Calificación obtenida en la encuesta docente.</label><br>
      <input type="text" name="calificacion" id="calificacion" placeholder="Calificación"><br>
      <label for="respuestas">Cantidad de respuestas en la encuesta docente.</label><br>
      <input type="number" name="respuestas" id="respuestas" placeholder="Cantidad"><br>
      <label for="material">Material docente.</label>
      <div>
        <input type="radio" id="si" name="material" value="si"
              checked>
        <label for="si">Si</label>
      </div>
      <div>
        <input type="radio" id="no" name="material" value="no">
        <label for="no">No</label>
      </div>
      <a href="" class="btn btn-primary">Añadir Curso</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Curso">
    <h3>Modificar Curso</h3>

  </section>

@endsection