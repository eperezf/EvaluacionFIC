<?php

namespace App\Exports;

//Importamos los modelos que utilizaremos
use App\User;
use App\Curso;
use App\Cargo;
use Auth;
use App\Actividad;
use App\User_actividad;
use App\Actividad_area;
use DB;

//Importamos los Concerns
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class EvaluacionDocenteExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    protected $idarea;

    function __construct($idarea)
    {
        $this->idarea = $idarea;
    }

    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            [
                'Evaluación Docente'
            ],
            [
                'A continuación debe calificar, con una nota del 1.0 al 7.0, a cada uno de los profesores según el desempeño realizado en sus respectivos cursos.'
            ],
            [
                'Cursos dictados durante el año académico'
            ],
            [],
            [
                'Id Curso',
                'Id Profesor',
                'Area',
                'Programa',
                'Curso',
                'Sección',
                'Periodo',
                'Profesor',
                'Alumnos Inscritos',
                'Respuestas Encuesta Docente',
                'Calificación Encuesta Docente',
                'Nota'
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,            
        ];
    }

    //Ponemos el estilo de texto de los encabezados en negrita
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true],
                  'font' => ['size' => 20]],

            5 => ['font' => ['bold' => true]]
        ];
    }

    //obtenemos los datos que queremos
    public function array(): array
    {
        //Obtenemos el id del area del Director de area que quiere descargar el excel
        $idarea = $this->idarea;
        
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
            'actividad.inicio as inicio',
            'actividad.termino as termino',
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

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($cursos)
            {
                //formateo de columna Periodo
                $meses = [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'];
                $cursos->inicio = $meses[intval(preg_split("/[-,]+/", $cursos->inicio)[1])].'-'.$meses[intval(preg_split("/[-,]+/", $cursos->termino)[1])];
                
                //formateo de columna Profesor
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
            $cursos->inicio,
            $cursos->nombresProfesor,
            $cursos->inscritos,
            $cursos->respuestas,
            $cursos->calificacion
        ];
    }
}
