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
}