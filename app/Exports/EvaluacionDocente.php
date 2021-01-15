<?php

namespace App\Exports;

use App\User;
use App\Curso;
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
        $data = DB::table('curso')
        ->join('actividad', 'curso.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->join('actividad_area', 'actividad.id', '=', 'actividad_area.idactividad')
        ->join('area', 'actividad_area.idarea', '=', 'area.id')
        ->join('actividad_asignatura', 'actividad.id', '=', 'actividad_asignatura.idactividad')
        ->join('asignatura', 'actividad_asignatura.idasignatura', '=', 'asignatura.id')
        ->select('asignatura.codigo', 'curso.seccion', 'user.nombres', 'user.apellidoPaterno', 'user.apellidoMaterno')
        ->orderBy('user.nombres')->get()->toArray();
        return $data;
    }

    //formateamos la columna de curso

/* Código sacado de la documentación de laravel-excel
    public function prepareRows(): array
    {
        return array_map(function ($user) {
            $user->name .= ' (prepared)';

            return $user;
        }, $rows);
    }
 */


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
