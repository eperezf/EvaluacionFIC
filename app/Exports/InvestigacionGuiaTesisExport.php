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
use PhpOffice\PhpSpreadsheet\Style\Fill;

class InvestigacionGuiaTesisExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Guías y/o co-Guías de Tésis en Programas Académicos'],
            ['A continuación debe calificar, con una nota el 1.0 al 7.0, a cada uno de los guías que aparecen a continuación.'],
            [],
            [
                'Id',
                'Id Académico',
                'Rut Académico',
                'Nombre Académico',
                'Apellido Académico',
                'Estudiante',
                'Programa',
                'Año',
                'Rol',
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

            4 => ['font' => ['bold' => true]],

            'A:B' =>
            [
                'fill' =>
                [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FDF2AB']
                ]
            ],

            'A1:B3' =>
            [
                'fill' =>
                [
                    'fillType' => Fill::FILL_NONE
                ]
            ]
        ];
    }
    
    public function array(): array
    {
        $guias = DB::table('guiatesis')
        ->join('actividad', 'guiatesis.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->join('programa', 'guiatesis.idprograma', '=', 'programa.id')
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->select(
            'guiatesis.id as id',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'guiatesis.estudiante',
            'programa.nombre as programa',
            'actividad.termino',
            'cargo.nombre as cargo',
            'user_actividad.calificacion')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $guias;
    }

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($guias)
            {
                //formateo de columna Año
                $guias->termino = explode('-',$guias->termino)[0];

                return $guias;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($guias): array
    {
        return [
            $guias->id,
            $guias->userid,
            $guias->rut,
            $guias->nombres,
            $guias->apellidoPaterno,
            $guias->estudiante,
            $guias->programa,
            $guias->termino,
            $guias->cargo
        ];
    }
}
