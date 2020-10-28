<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;
use App\Area;

class ApiController extends Controller
{
  public function getAreas($name){
    return response(Area::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }
}
