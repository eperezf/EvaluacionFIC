<?php

namespace App\Exports;

use App\User;
use App\Curso;
use Auth;
use App\Actividad;
use App\User_actividad;
use App\Actividad_area;
use DB;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EvaluacionDocenteExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            'Id Curso',
            'Id Profesor',
            'Area',
            'Programa',
            'Curso',
            'Sección',
            'Profesor',
            'Alumnos Inscritos',
            'Respuestas Encuesta Docente',
            'Calificación Encuesta Docente',
            'Nota',
            'Comentario al comité evaluador'
        ];
    }

    //Ponemos el estilo de texto de los encabezados en negrita
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }

    //obtenemos los datos que queremos
    public function array(): array
    {
        //Obtenemos el id del area del Director de area que quiere descargar el excel
        $idactividad = Auth::user()->actividad()
        ->where('idtipoactividad', '=', '4')
        ->where('idcargo', '=', '6')
        ->get(['actividad.id']);
        
        $idarea = Actividad_area::select('idarea')
        ->where('idactividad', '=', $idactividad[0]->id)
        ->get()[0]
        ->idarea;

        //Obtenemos todos los cursos asociados al area de dicho director
        $cursos = DB::table('curso')
        ->join('asignatura', 'curso.idasignatura', '=', 'asignatura.id')
        ->join('subarea', 'asignatura.idsubarea', '=', 'subarea.id')
        ->join('actividad', 'curso.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->join('area', 'subarea.idarea', '=', 'area.id')
        ->select(
            'curso.id as idCurso',
            'user.id as idProfesor',
            'area.nombre as nombreArea',
            'subarea.nombre as nombreSubarea',
            'asignatura.nombre as nombreAsignatura',
            'curso.seccion',
            'user.nombres as nombresProfesor',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'user.rut',
            'curso.inscritos',
            'curso.respuestas',
            'curso.calificacion')
        ->where('subarea.idarea', 'LIKE', $idarea)
        ->get()->
        toArray();

        return $cursos;
    }

    //formateamos la columna Profesor
    public function prepareRows($rows): array
    {
        return array_map(
            function ($cursos)
            {
                $cursos->nombresProfesor = $cursos->nombresProfesor.' '.$cursos->apellidoPaterno.' '.$cursos->apellidoMaterno;
                return $cursos;
            }, $rows
        );
    }



    //ponemos los datos obtenidos en columnas
    public function map($cursos): array
    {
        return [
            $cursos->idCurso,
            $cursos->idProfesor,
            $cursos->nombreArea,
            $cursos->nombreSubarea,
            $cursos->nombreAsignatura,
            $cursos->seccion,
            $cursos->nombresProfesor,
            $cursos->inscritos,
            $cursos->respuestas,
            $cursos->calificacion
        ];
    }
}
