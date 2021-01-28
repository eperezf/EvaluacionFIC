<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\User;
use App\Area;
use App\Helper\Helper;
use App\Imports\EvaluacionDocenteImport;
use App\Http\Requests\StoreEvalDocente;

use Maatwebsite\Excel\Facades\Excel;

use DB;

class MenuAdministrador extends Controller
{
    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $areas = Area::all();
        return view('menu.administrador.index', [
            'nombre' => $nombre, 
            'usuarios' => [],
            'menus' => $menus,
            'areas' => $areas
        ]);
    }

    public function searchLetter($letra)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $areas = Area::all();
        
        $usuarios = User::where('apellidoPaterno', 'LIKE', $letra.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.administrador.index', ['nombre' => $nombre, 'areas' => $areas, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function searchInput(Request $request)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $areas = Area::all();
        //Obenemos los usuarios que calcen con el valor del input ingresado
        $usuarios = User::where(DB::raw("CONCAT_WS(' ', user.nombres, user.apellidoPaterno, user.apellidoMaterno)"), 'LIKE', '%'.$request->search.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.administrador.index', ['nombre' => $nombre, 'areas' => $areas, 'usuarios' => $usuarios, 'menus' => $menus]);
    }
}
