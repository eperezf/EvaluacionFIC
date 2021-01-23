@extends('includes/template')

@section('title', 'Ver Cargos')

@section('contenido')
  <h3>Perfil de {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h3><hr>
  <div id="container" class="row">
    <div id="cargosSideBar" class="col-3">
      <div id="sidebarHeader" class="row">
        <h3 class="col-6">Cargos</h3>
        <a href="{{ route('agregarCargo', ['userId' => $usuario->id]) }}" class="pt-2 ml-2">Agregar cargo</a>
      </div>
      <div class="nav flex-column nav-pills" id="cargos" role="tablist" aria-orientation="vertical">
        <a href="{{ route('verCargos', ['userId' => $usuario->id, 'cargoId' => 'all']) }}" class="nav-link {{ $selectedCargoId == 0 ? 'active': '' }}" aria-selected="true">Todos los cargos</a>
        @foreach ($cargos as $cargo)
          <a href="{{ route('verCargos', ['userId' => $usuario->id, 'cargoId' => $cargo->id]) }}" class="nav-link {{ $selectedCargoId == $cargo->id ? 'active': '' }}">{{ $cargo->nombre }}</a>
        @endforeach
      </div>
    </div>
    <div id="actividades" class="col-9">
      <h3>Actividades</h3>
      @if ($actividades != NULL)
        @foreach ($actividades as $actividad)
          <div class="card mb-2">
            <div class="card-body">
              <h5>
                @switch($actividad->idcargo)
                  @case(1) {{-- Administrador --}}
                    Administrador</h5>
                    
                    @break
                  @case(2) {{-- Director de investigacion --}}
                    Director de investigacion</h5>
                    
                    @break
                  @case(3) {{-- Director ejecutivo de investigacion --}}
                    Director ejecutivo de investigacion</h5>
                    
                    @break
                  @case(4) {{-- Director de docencia --}}
                    Director de docencia</h5>
                    
                    @break
                  @case(5) {{-- Subdirector de docencia --}}
                    Subdirector de docencia</h5>

                    @break
                  @case(6) {{-- Director de area --}}
                    Director de area</h5>
                      
                    @break
                  @case(7) {{-- Profesor --}}
                    Profesor</h5>

                    @break
                  @default
                @endswitch
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection
