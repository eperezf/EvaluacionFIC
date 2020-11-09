<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;
use App\Area;
use App\Asignatura;
use App\Subarea;
use App\PerfeccionamientoDocente;
use App\ProyectoConcursable;
use App\Spinoff;
use App\TransferenciaTecnologica;
use App\Vinculacion;
use App\Tutoria;
use App\Licencia;

use App\Actividad_Asignatura;
use App\Actividad_Area;
use App\Libro;
use App\Actividad;
use App\Curso;
use App\Publicacion;

class ApiController extends Controller
{
  public function getAreas($name){
    return response(Area::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getAsignatura($name){
    return response(Asignatura::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }
  
  public function getSubarea($name){
    return response(Subarea::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getPerfeccionamientoDocente($name){
    return response(PerfeccionamientoDocente::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getProyectoConcursable($name){
    return response(ProyectoConcursable::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getSpinoff($name){
    return response(Spinoff::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getTransferenciaTecnologica($name){
    return response(TransferenciaTecnologica::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getVinculacion($name){
    return response(Vinculacion::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getTutoria($name){
    return response(Tutoria::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }
  
  public function getLicencia($name){
    return response(Licencia::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  
  public function getActividadAsignatura($name){
    return response(Actividad_Asignatura::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getActividadArea($name){
    return response(Actividad_Area::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getLibro($name){
    return response(Libro::where('titulo', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }
  
  public function getCurso($name){
    return response(Curso::where('nombre', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }

  public function getPublicacion($name){
    return response(Publicacion::where('titulo', 'LIKE', '%'.$name.'%')->get())->header('Content-Type', 'application/json');
  }
}
