<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;
use Illuminate\Support\Facades\DB;
use App\Asignatura;

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

    function loadCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        return view('curso', compact('asignaturas', $asignaturas));
    }

    function loadArea()
    {
        return view('area');
    }
    
    function loadCargoAdministrativo()
    {
        return view('cargoAdministrativo');
    }
}
