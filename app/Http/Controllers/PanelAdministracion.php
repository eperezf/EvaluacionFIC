<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;
use App\Asignatura;
use App\Tipoactividad;
use App\Area;

class PanelAdministracion extends Controller
{
    public function loadPanelAdministracion()
    {
        return view('panelAdministracion');
    }

    function loadPublicacion()
    {
        return view('publicacion');
    }

    function loadTipoActividad()
    {
        return view('tipoActividad');
    }

    function loadAsignatura()
    {
        return view('asignatura');
    }

    function loadTutoria()
    {
        return view('tutoria');
    }

    function loadActividad()
    {
        $tipos = Tipoactividad::all(['id','nombre']);
        return view('actividad', compact('tipos', $tipos));
    }

    function loadCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        return view('curso', compact('asignaturas', $asignaturas));
    }

    function loadArea()
    {
        return view('area');
    }

    function loadSubarea() {
        $areas = Area::all(['id', 'nombre']);
        return view('subarea', compact('areas', $areas));
    }
    
    function loadCargoAdministrativo()
    {
        return view('cargoAdministrativo');
    }
}
