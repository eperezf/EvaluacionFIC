<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Acaronlex\LaravelCalendar\Event;
use Acaronlex\LaravelCalendar\Calendar;
use Carbon\Carbon;

use App\Asignatura;
use App\Area;
use App\Subarea;
use App\PerfeccionamientoDocente;
use App\Libro;
use App\Actividad;
use App\Licencia;
use App\Proyectoconcursable;
use App\Spinoff;
use App\TransferenciaTecnologica;
use App\Actividad_Asignatura;
use App\Actividad_area;
use App\Vinculacion;
use App\Curso;
use App\Tutoria;
use App\Publicacion;
use App\User_actividad;
use App\Cargo;
use App\Helper\Helper;

class NoticiasAgenda extends Controller {
  public function loadNoticiasAgenda() {
    $actividades = Auth::user()->actividad()->orderBy('updated_at', 'desc')->get();
    $events = [];
    $cargos = [];
    $nombreActividades = [];
    foreach ($actividades as $actividad) {
      $tipoActividad = $actividad->idtipoactividad;
      $actividadUser = User_actividad::where('idactividad', $actividad->id)->get()[0]; //(idactividad, idacrgo)
      $cargo = Cargo::where('id', $actividadUser->idcargo)->get('nombre')[0];
      array_push($cargos, $cargo->nombre);
      $nombreActividad = "";

      //Segun el tipo de actividad se realiza la busqueda de los datos
      switch($tipoActividad)
      {
        case 4: //Actividad area
          $area = Area::where('id', Actividad_area::where('idactividad', $actividadUser->idactividad)->get('idarea')[0]->idarea)->get()[0];
          $nombreActividad = $area->nombre;
        break;
        case 5: //Actividad asignatura
          $asignatura = Asignatura::where('id', Actividad_Asignatura::where('idactividad', $actividadUser->idactividad)->get('idasignatura')[0]->idasignatura)->get()[0];
          $nombreActividad = $asignatura->nombre;
          break;
        case 6: //Curso
          // TICS101/2
          $curso = Curso::where('idactividad', $actividadUser->idactividad)->get()[0];
          $seccion = $curso->seccion;
          $codigo = Asignatura::where('id', $curso->idasignatura)->get('codigo')[0]->codigo;
          $nombreActividad = $codigo."-".$seccion;
          break;
        case 7: //Libro
          $libro = Libro::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $libro->titulo;
          break;
        case 8: //Licencia
          $licencia = Licencia::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $licencia->nombre;
          break;
        case 9: //Perfeccionamiento docente
          $perfeccionamiento = PerfeccionamientoDocente::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $perfeccionamiento->nombre;
          break;
        case 10: //Proyecto concursable
          $proyecto = Proyectoconcursable::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $proyecto->nombre;
          break;
        case 11: //Publicación
          $publicacion = Publicacion::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $publicacion->titulo;
          break;
        case 12: //Spinoff
          $spinoff = Spinoff::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $spinoff->nombre;
          break;
        case 13: //Transferencia tecnológica
          $transferencia = TransferenciaTecnologica::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $transferencia->nombre;
          break;
        case 14: //Tutoría
          $tutoria = Tutoria::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $tutoria->nombre;
          break;
        case 15: //Vinculación
          $vinculacion = Vinculacion::where('idactividad', $actividadUser->idactividad)->get()[0];
          $nombreActividad = $vinculacion->nombre;
          break;
        default: //Default
          break;
      }
      array_push($nombreActividades, $nombreActividad);
      $events[] = \Calendar::event(
          $cargo->nombre." en ".$nombreActividad, //event title
          false, //full day event?
          $actividad->inicio." 9:00", //start time (you can also use Carbon instead of DateTime)
          $actividad->termino." 9:00", //end time (you can also use Carbon instead of DateTime)
      	'stringEventId' //optionally, you can specify an event ID
      );
    }
    $calendar = new Calendar();
    $calendar->addEvents($events)->setOptions([
      'locale' => 'es',
      'timeZone' =>'America/Santiago',
      'firstDay' => 1,
      'selectable' => false,
      'headerToolbar' => [
        'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
      ]
    ]);
    $calendar->setId('1');
    $nombres = Auth::user()->nombres;
    return view('noticiasAgenda', compact('calendar'), [
      'nombres' => $nombres,
      'actividades' => $actividades,
      'cargos' => $cargos,
      'nombreActividades' => $nombreActividades,
      'menus' => Helper::getMenuOptions(Auth::user()->id)
      ]);
  }
}
