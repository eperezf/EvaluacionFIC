@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h2>Panel de Administración</h2><hr>
  <div id="container" class="row">
    <div id="formulariosSidebar" class="col-3">
      <div id="sidebarHeader">
        <h4>Actividades</h4>
      </div>
      <div class="nav flex-column nav-pills" id="formularios" role="tablist" aria-orientation="vertical">
        @foreach ($tipoActividades as $tipoActividad)
          <a href="{{ route('panelAdministracion', ['activityId' => $tipoActividad->id]) }}" class="nav-link {{ $selectedActivity == $tipoActividad->id ? 'active': '' }}">{{ $tipoActividad->nombre }}</a>
        @endforeach
      </div>
    </div>
    <div id="formulario" class="col-9">
      @if($selectedActivity == "none")
        <h5>Seleccione un tipo de actividad</h5>
      @else
        <h5>{{ $tipoActividades[$selectedActivity-3]->nombre }}</h5>
      @endif
    </div>
  </div>
@endsection
