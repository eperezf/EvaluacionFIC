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

class AdministracionAcademicaExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Administración Académica'],
            ['A continuación debe calificar, con una nota el 1.0 al 7.0, a cada una de las actividades de administración académica con el medio que aparecen a continuación.'],
            [],
            [
                'Id',
                'Id Académico',
                'Rut Académico',
                'Nombre Académico',
                'Apellido Académico',
                'Programa',
                'Área',
                'Actividad',
                'Meses',
                'Carga',
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
            1 =>
            [
                'font' =>
                [
                    'bold' => true,
                    'size' => 20
                ]
            ],

            4 =>
            [
                'font' => ['bold' => true]
            ],

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
        $administracionacademica = DB::table('administracionacademica')
        ->join('actividad', 'administracionacademica.idactividad', '=', 'actividad.id')
        ->join('actividad_area', 'actividad.id', '=', 'actividad_area.idactividad')
        ->join('area', 'area.id', '=', 'actividad_area.idarea')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->join('tipoactividad', 'tipoactividad.id', '=', 'actividad.idtipoactividad')
        ->select(
            'administracionacademica.id as id',
            'administracionacademica.meses',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'administracionacademica.programa',
            'cargo.nombre as actividad',
            'user_actividad.carga',
            'user_actividad.calificacion',
            'area.nombre as area')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $administracionacademica;
    }

    //ponemos los datos obtenidos en columnas
    public function map($administracionacademica): array
    {
        return [
            $administracionacademica->id,
            $administracionacademica->userid,
            $administracionacademica->rut,
            $administracionacademica->nombres,
            $administracionacademica->apellidoPaterno,
            $administracionacademica->programa,
            $administracionacademica->area,
            $administracionacademica->actividad,
            $administracionacademica->meses,
            $administracionacademica->carga
        ];
    }
}
