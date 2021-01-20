<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\User_actividad;
use App\Cargo;

use App\Helper\Helper;

class Index extends Controller
{
    public function loadIndex()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id); 
        if(!Auth::user())
        {
            return redirect('\login');
        }
        else
        {
            return view('index', ['nombre' => $nombre, 'menus' => $menus]);
        }
    }
}
