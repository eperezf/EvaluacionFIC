<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargoAdministrativo extends Controller
{
    function loadCargoAdministrativo()
    {
        return view('cargoAdministrativo');
    }
    
}
