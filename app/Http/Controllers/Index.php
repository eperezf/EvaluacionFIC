<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\User_actividad;
use App\Cargo;

class Index extends Controller
{
    private function getMenuOptions($userid)
    {
        $cargosId = User_actividad::where('iduser', $userid)->get('idcargo');
        $cargos = [];
        foreach($cargosId as $cargoId)
        {
            array_push($cargos, $cargoId->idcargo);
        }

        $opciones = [];
        (in_array(1, $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo administración
        (in_array(2, $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo docente
        (in_array(3, $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo profesor
        
        return $opciones;
    }

    public function loadIndex()
    {
        $nombre = Auth::user()->nombres;
        $opciones = $this->getMenuOptions(Auth::user()->id);
        if(!Auth::user())
        {
            return redirect('\login');
        }
        else
        {
            return view('index', ['nombre' => $nombre, 'opciones' => $opciones]);
        }
    }

    /* Función temporal para la carga del HDU docente */
    public function loadDocente()
    {
        $nombre = Auth::user()->nombres;
        $opciones = $this->getMenuOptions(Auth::user()->id);
        return view('menu\docente', ['nombre' => $nombre, 'opciones' => $opciones]);
    }

    public function search($letra)
    {
        $nombre = Auth::user()->nombres;
        $usuarios = User::where('apellidoPaterno', 'LIKE', $letra.'%')
            ->get([
                'id',
                'nombres',
                'apellidoPaterno',
                'apellidoMaterno'
            ]);
        return view('index', ['nombre' => $nombre, 'usuarios' => $usuarios]);
    }

}
