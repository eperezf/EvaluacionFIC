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

class InvestigacionPublicacionesCientificasExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Publicaciones Científicas'],
            ["Lea atentamente las siguientes indicaciones:"],
            ['Para completar este documento debe tener en consideración los siguientes pasos:
            1. Las columnas de color amarillo no deben ser rellenadas.
            2. En la columna "Rut académico" debe escribir el rut del profesor con guión y sin puntos.
            3. En la columna "Nombre académico" y "Apellido académico" debe escribir dicha información con tilde y en mayúscula.
            4. En la columna "Título publicación" debe escribir el nombre del paper.
            5. En la columna "Journal" debe escribir el nombre de la revista en la cual fue publicado el paper.
            6. En la columna "Año" debe escribir el año de publicación.
            7. En la columna "Indexación o tipo" debe escribir el sitio donde está difundida la publicación.
            8. Solo de ser necesario en columna "Nota" debe escribir un número entre 1.0 a 7.0, es decir, el número tiene que ser separado por punto. Esto para evaluar el desempeño 
            del profesor en esa actividad.
            '],
            [
                'Id',
                'Id Académico',
                'Rut Académico',
                'Nombre Académico',
                'Apellido Académico',
                'Título Publicación',
                'Journal',
                'Año',
                'Indexación o Tipo',
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
        $publicaciones = DB::table('publicacioncientifica')
        ->join('actividad', 'publicacioncientifica.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->select(
            'publicacioncientifica.id as id',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'publicacioncientifica.titulo',
            'publicacioncientifica.journal',
            'actividad.termino',
            'publicacioncientifica.indexacion',
            'user_actividad.calificacion')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $publicaciones;
    }

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($publicaciones)
            {
                //formateo de columna Año
                $publicaciones->inicio = explode('-', $publicaciones->inicio)[0].'-'.explode('-', $publicaciones->termino)[0];

                return $publicaciones;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($publicaciones): array
    {
        return [
            $publicaciones->id,
            $publicaciones->userid,
            $publicaciones->rut,
            $publicaciones->nombres,
            $publicaciones->apellidoPaterno,
            $publicaciones->titulo,
            $publicaciones->journal,
            $publicaciones->inicio,
            $publicaciones->indexacion
        ];
    }
}
