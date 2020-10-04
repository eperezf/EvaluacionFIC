<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('curso');
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
