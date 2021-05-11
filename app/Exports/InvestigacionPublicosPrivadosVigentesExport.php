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
            ['Lea atentamente las siguientes indicaciones:'],
            ['Para completar este documento debe tener en consideración los siguientes pasos:
            1. Las columnas de color amarillo no deben ser rellenadas.
            2. En la columna "Rut académico" debe escribir el rut del profesor con guión y sin puntos.
            3. En la columna "Nombre académico" y "Apellido académico" debe escribir dicha información con tilde y en mayúscula.
            4. En la columna "Fuente - Programa de financiamiento" debe escribir si el proyecto es público, privado o interno, también la empresa que los financia y el nombre
            en específico del programa, todo eso separado por "/". (Ej: Interno/ UAI / DI)
            5. En la columna "Nombre Proyecto" debe escribir el título del proyecto de investigación, en mayúscula y con tilde (de ser necesario).
            6. En la columna "Periodo" debe escribir los años que duró el proyecto, el formato debe ser año de inicio - año de término. (Ej: 2016 - 2019)
            7. En la columna "Rol" debe escribir que función cumple el profesor en el proyecto. (tipo de investigador)
            8. Solo de ser necesario en columna "Nota" debe escribir un número entre 1.0 a 7.0, es decir, el número tiene que ser separado por punto.
            Esto para evaluar el desempeño del profesor en esa actividad.
            '],
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
        $sheet->mergeCells('A3:J3');
        $sheet->getRowDimension('3')->setRowHeight(165);

        return [
            1 => ['font' => ['bold' => true],
                    'font' => ['size' => 20]],

            2 => ['font' => ['bold' => true, 'underline' => true]],

            3 => ['alignment' => ['wrapText' => true]],

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
