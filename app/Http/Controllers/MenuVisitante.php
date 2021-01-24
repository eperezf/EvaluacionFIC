<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
        $usuarios = User::where('nombres', 'LIKE', $letra.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.visitante.buscador', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
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
        return view('menu.visitante.buscador', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }
}