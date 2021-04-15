<?php

namespace App\Exports;


//Importaciones
use DB;

//Importamos los Concerns
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VCMExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Vinculación con el Medio'],
            ['A continuación debe calificar, con una nota el 1.0 al 7.0, a cada una de las vinculaciones con el medio que aparecen a continuación.'],
            [],
            [
                'Id',
                'Id Académico',
                'Rut Profesor',
                'Nombre',
                'Tipo de Actividad',
                'Periodo',
                'Detalle',
                'Nota'
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,            
        ];
    }
    
    //Ponemos el estilo de texto de los encabezados en negrita
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true],
                  'font' => ['size' => 20]],

            4 => ['font' => ['bold' => true]]
        ];
    }
    
    public function array(): array
    {
        $vinculacion = DB::table('vinculacion')
        ->join('actividad', 'vinculacion.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->join('tipoactividad', 'tipoactividad.id', '=', 'actividad.idtipoactividad')
        ->select(
            'vinculacion.id as id',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'tipoactividad.nombre as tipoactividad',
            'vinculacion.detalle',
            'user_actividad.calificacion')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $vinculacion;
    }

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($vinculacion)
            {
                //formateo de columna Profesor
                $vinculacion->nombres = $vinculacion->nombres.' '.$vinculacion->apellidoPaterno.' '.$vinculacion->apellidoMaterno;

                return $vinculacion;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($vinculacion): array
    {
        return [
            $vinculacion->id,
            $vinculacion->userid,
            $vinculacion->rut,
            $vinculacion->nombres,
            $vinculacion->tipoactividad,
            'Periodo',
            $vinculacion->detalle,
        ];
    }
}
