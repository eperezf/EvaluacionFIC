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

    function loadAgregarPublicacion()
    {
        return view('agregarPublicacion');
    }

    function loadAgregarTipoActividad()
    {
        return view('agregarTipoActividad');
    }

    function loadAgregarAsignatura()
    {
        return view('agregarAsignatura');
    }

    function loadAgregarTutoria()
    {
        return view('agregarTutoria');
    }

    function loadAgregarActividad()
    {
        $tipos = Tipoactividad::all(['id','nombre']);
        return view('agregarActividad', compact('tipos', $tipos));
    }

    function loadAgregarCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        return view('agregarCurso', compact('asignaturas', $asignaturas));
    }

    function loadAgregarArea()
    {
        return view('agregarArea');
    }

    function loadAgregarSubarea() {
        $areas = Area::all(['id', 'nombre']);
        return view('agregarSubarea', compact('areas', $areas));
    }
    
    function loadAgregarCargoAdministrativo()
    {
        return view('agregarCargoAdministrativo');
    }
}
