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
        /* dd($opciones); */

        /* Datos para la vista */

        $rutas = ['panelAdministracion', 'panelDocente', 'panelProfesor'];
        $iconos = ["fas fa-columns mr-1", "far fa-user mr-1", "far fa-user mr-1"];
        $texto = ["Panel Administración", "Panel Docente", "Panel Profesor"];

        $menus = array_map(NULL, $opciones, $rutas, $iconos, $texto);

        /* dd($menus); */
        
        return array($cargos, $menus);
    }

    public function loadIndex()
    {
        $nombre = Auth::user()->nombres;
        list($cargosId, $menus) = $this->getMenuOptions(Auth::user()->id); 
        if(!Auth::user())
        {
            return redirect('\login');
        }
        else
        {
            return view('index', ['nombre' => $nombre, 'menus' => $menus, 'cargos' => $cargosId]);
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
