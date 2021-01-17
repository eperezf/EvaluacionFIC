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

class EvaluacionDocente implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            'Curso',
            'Nombres',
            'Apellido Paterno',
            'Apellido Materno',
            'Nota'
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
        ->select('asignatura.codigo', 'curso.seccion', 'user.nombres', 'user.apellidoPaterno', 'user.apellidoMaterno')
        ->where('subarea.idarea', 'LIKE', $idarea)->get()->toArray();
        return $cursos;
    }

    //formateamos la columna de curso
    public function prepareRows($rows): array
    {
        return array_map(
            function ($data)
            {
                $data->codigo = $data->codigo.'-Sec. '.$data->seccion;      //Formato del curso por confirmar

                return $data;
            }, $rows
        );
    }



    //ponemos los datos obtenidos en columnas
    public function map($data): array
    {
        return [
            $data->codigo,
            $data->nombres,
            $data->apellidoPaterno,
            $data->apellidoMaterno,
        ];
    }
}
