<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\User;
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
        return view('menu.administrador.index', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    }

    public function searchLetter($letra)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $usuarios = User::where('apellidoPaterno', 'LIKE', $letra.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.administrador.index', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function searchInput(Request $request)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        //Obenemos los usuarios que calcen con el valor del input ingresado
        $usuarios = User::where(DB::raw("CONCAT_WS(' ', user.nombres, user.apellidoPaterno, user.apellidoMaterno)"), 'LIKE', '%'.$request->search.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.administrador.index', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function importNotas(StoreEvalDocente $request)
    {
        /* Se valida el formulario y al retornar exito, se ejecuta Excel::import() */
        $validated = $request->validated();
        Excel::import(new EvaluacionDocenteImport, $request->file('file'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }
}
