<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Curso extends Controller
{
    function loadCurso()
    {
        return view('curso');
    }
}
