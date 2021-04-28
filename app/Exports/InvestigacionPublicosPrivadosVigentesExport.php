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

class InvestigacionPublicosPrivadosVigentesExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Públicos y Privados Vigentes'],
            ['A continuación debe calificar, con una nota el 1.0 al 7.0, a cada una de las investigaciones que aparecen a continuación.'],
            [],
            [
                'Id',
                'Id Académico',
                'Rut Académico',
                'Nombre Académico',
                'Apellido Académico',
                'Fuente - Programa de Financiamiento',
                'Nombre Proyecto',
                'Periodo',
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
        $investigaciones = DB::table('proyectoinvestigacion')
        ->join('actividad', 'proyectoinvestigacion.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->join('fuentefinanciamiento', 'fuentefinanciamiento.id', '=', 'proyectoinvestigacion.idfuentefinanciamiento')
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->select(
            'proyectoinvestigacion.id as id',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'fuentefinanciamiento.nombre as fuente',
            'proyectoinvestigacion.nombre as proyecto',
            'actividad.inicio',
            'actividad.termino',
            'cargo.nombre as cargo',
            'user_actividad.calificacion')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $investigaciones;
    }

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($investigaciones)
            {
                //formateo de columna Año
                $investigaciones->inicio = explode('-', $investigaciones->inicio)[0].'-'.explode('-', $investigaciones->termino)[0];

                return $investigaciones;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($investigaciones): array
    {
        return [
            $investigaciones->id,
            $investigaciones->userid,
            $investigaciones->rut,
            $investigaciones->nombres,
            $investigaciones->apellidoPaterno,
            $investigaciones->fuente,
            $investigaciones->proyecto,
            $investigaciones->inicio,
            $investigaciones->cargo
        ];
    }
}
