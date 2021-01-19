@extends('includes/template')
@section('title', 'Agenda y Noticias')

@section('extra_header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css">
@endsection

@section('contenido')
<div class="row mb-3 justify-content-center">
  <h1 class=" mb-3">Agenda y Noticias de {{$nombres}}</h1>
</div>
<div class="row mt-3">
  <div class="col-12">
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
  </div>
</div>
<div class="row mt-3">
  <div class="col-12 text-center">
    <h1 class=" mb-3">Modificaciones recientes</h1>
  </div>
  @php ($i = 0)
  @foreach ($actividades as $actividad)
  <div class="col-4">
    <div class="card">
      <div class="card-header">
        {{ $cargos[$i] }} en {{ $nombreActividades[$i] }}
      </div>
      <div class="card-body">
        <p>Cargo: {{$actividad->pivot->cargo->nombre}}</p>
        <p>Fecha de inicio: {{Carbon\Carbon::parse($actividad->inicio)->locale('es_ES')->isoFormat('LL')}}</p>
        <p>Fecha de término: {{Carbon\Carbon::parse($actividad->termino)->locale('es_ES')->isoFormat('LL')}}</p>
        <a href="#" class="btn btn-primary">Ver actividad</a>
      </div>
    </div>
  </div>
  @php ($i++)
  @endforeach
</div>


@endsection

@section('extra_footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/locales/es.min.js"></script>
@endsection
