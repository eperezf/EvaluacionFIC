<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Area extends Controller
{
    function loadArea()
    {
        return view('area');
    }
}
