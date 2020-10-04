<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Publicacion extends Controller
{
    function loadPublicacion()
    {
        return view('publicacion');
    }
}
