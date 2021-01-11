<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Curso;
use App\Helper\Helper;
use DB;

class MenuProfesor extends Controller
{
    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.profesor.profesor', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    } 
    
    public function loadCursos()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.profesor.vercursos', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    }     
}
