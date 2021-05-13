@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h2>Panel de Administración</h2><hr>
  <div id="container" class="row">
    <div id="formulariosSidebar" class="col-3 border-right">
      <div id="sidebarHeader">
        <h4>Actividades</h4>
      </div>
      <div class="nav flex-column nav-pills" id="formularios" role="tablist" aria-orientation="vertical">
        @foreach ($tipoActividades as $tipoActividad)
          <a href="{{ route('panelAdministracion', ['activityId' => $tipoActividad->id]) }}" class="nav-link {{ $selectedActivity == $tipoActividad->id ? 'active': '' }}">{{ $tipoActividad->nombre }}</a>
        @endforeach
      </div>
    </div>
    <div id="formulario" class="col-9 align-middle">
      @if($selectedActivity == "none")
        <div class="text-center">
          <h5>Seleccione un tipo de actividad</h5>
        </div>
      @else
        <div id="formTitle">
          <h5>{{ $tipoActividades[$selectedActivity-3]->nombre }}</h5>
        </div>  
        <section id="modificarSection">
          <div class="row col-12">
            <input type="text" class="form-control col-9 mx-2" placeholder="Buscar {{ $tipoActividades[$selectedActivity-3]->nombre }}">
            <button class="btn btn-primary col-2 ml-4">Buscar</button>
          </div>
          <div id="resultadosBusqueda">
            {{-- HTML para obtener resultados. Evaluar mejor forma cuando sea necesario --}}
          </div>
        </section>
        <br>
        <div id="addSectionTitle">
          <h5>Agregar {{ $tipoActividades[$selectedActivity-3]->nombre }}</h5>
        </div><hr>
        <section id="agregarSection">
          <form action="POST">
            @csrf
            {{-- JavaScript Division --}}
            <div id="formInputs">

            </div>
          </form>
        </section>
      @endif
    </div>
  </div>
  <script type="text/javascript" src="{{ asset('js/panelAdminForms.js') }}"></script>
@endsection
