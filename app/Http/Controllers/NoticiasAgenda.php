<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Acaronlex\LaravelCalendar\Event;
use Acaronlex\LaravelCalendar\Calendar;
use Carbon\Carbon;

class NoticiasAgenda extends Controller {
  public function loadNoticiasAgenda() {
    $actividades = Auth::user()->actividad()->orderBy('updated_at', 'desc')->get();
    $events = [];
    foreach ($actividades as $actividad) {
      $events[] = \Calendar::event(
          "Actividad", //event title
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
    return view('noticiasAgenda', compact('calendar'), ['nombres' => $nombres, 'actividades'=>$actividades]);
  }
}
