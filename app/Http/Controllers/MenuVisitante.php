<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cargo;
use App\Helper\Helper;
use DB;

class MenuVisitante extends Controller
{
    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.visitante.index', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    }

    public function postSolicitarAcceso(Request $new_request)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);

        $success = 'Usted ha solicitado acceso exitosamente, por favor espere un momento.';
        return redirect('/visitante')->with('success', $success);
    }

    public function loadBuscador()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.visitante.buscador', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    }

    public function searchLetter($letra)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Obtenemos el los usuarios que tengan el cargo de profesor y coincidan con la letra */
        $usuarios = DB::table('user')
        ->join('user_actividad', 'user.id', '=', 'user_actividad.iduser')
        ->where('user_actividad.idcargo', 'LIKE', Cargo::where('nombre', 'Profesor')->get()[0]->id)
        ->where('user.apellidoPaterno', 'LIKE', $letra.'%')
        ->distinct()
        ->get([
            'user.id',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno'
        ]);

        return view('menu.visitante.buscador', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function searchInput(Request $request)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        
        //Obenemos los usuarios que calcen con el valor del input ingresado
        $usuarios = DB::table('user')
        ->join('user_actividad', 'user.id', '=', 'user_actividad.iduser')
        ->where('user_actividad.idcargo', '=', Cargo::where('nombre', 'Profesor')->get()[0]->id)
        ->where(DB::raw("CONCAT_WS(' ', user.nombres, user.apellidoPaterno, user.apellidoMaterno)"), 'LIKE', '%'.$request->search.'%')
        ->distinct()
        ->get([
            'user.id',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno'
        ]);
        return view('menu.visitante.buscador', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }
}