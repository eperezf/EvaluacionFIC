<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\User;
use App\Subarea;
use App\Helper\Helper;
use App\Imports\EvaluacionDocenteImport;
use App\Http\Requests\StoreEvalDocente;

use Maatwebsite\Excel\Facades\Excel;

use DB;

class MenuAdministrador extends Controller
{
    private function userControllerInfo()
    {
        // Variables de datos del usuario
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        
        // Variables necesarios para el controlador (Buzones)
        $subareas = Subarea::all();
        $investigaciones = collect(
            [
                ['nombre' => "Publicaciones Científicas", 'id' => "publicacion"],
                ['nombre' => "Patentes", 'id' => "patente"],
                ['nombre' => "Guías y co-guías de tesis", 'id' => "guia"],
                ['nombre' => "Proyectos de investigación", 'id' => "proyecto"]
            ]
        );

        return array($nombre, $menus, $subareas, $investigaciones);
    }

    public function load()
    {
        $controllerData = $this->userControllerInfo();

        return view('menu.administrador.index', [
            'nombre' => $controllerData[0],
            'menus' => $controllerData[1],
            'subareas' => $controllerData[2],
            'investigaciones' => $controllerData[3],
            'usuarios' => []
        ]);
    }

    public function searchLetter($letra)
    {
        $controllerData = $this->userControllerInfo();

        // Obtenemos los usuarios que tengan la letra buscada como inicial del apellido paterno
        $usuarios = User::where('apellidoPaterno', 'LIKE', $letra.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);

        return view('menu.administrador.index', [
            'nombre' => $controllerData[0],
            'menus' => $controllerData[1],
            'subareas' => $controllerData[2],
            'investigaciones' => $controllerData[3],
            'usuarios' => $usuarios
        ]);
    }

    public function searchInput(Request $request)
    {
        $controllerData = $this->userControllerInfo();

        //Obenemos los usuarios que calcen con el valor del input ingresado
        $usuarios = User::where(DB::raw("CONCAT_WS(' ', user.nombres, user.apellidoPaterno, user.apellidoMaterno)"), 'LIKE', '%'.$request->search.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);

        return view('menu.administrador.index', [
            'nombre' => $controllerData[0],
            'menus' => $controllerData[1],
            'subareas' => $controllerData[2],
            'investigaciones' => $controllerData[3],
            'usuarios' => $usuarios
        ]);
    }
}
