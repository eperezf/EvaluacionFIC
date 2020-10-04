<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelAdministracion extends Controller
{
    public function loadPanelAdministracion()
    {
        return view('panelAdministracion');
    }
}
