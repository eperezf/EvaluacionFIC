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

class InvestigacionPublicacionesCientificasExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Publicaciones Científicas'],
            ['A continuación debe calificar, con una nota el 1.0 al 7.0, a cada una de las publicaciones científicas que aparecen a continuación.'],
            [],
            [
                'Rut Profesor',
                'Nombre',
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
        return [
            1 => ['font' => ['bold' => true],
                    'font' => ['size' => 20]],

            4 => ['font' => ['bold' => true]]
        ];
    }

    public function array(): array
    {
        $publicaciones = DB::table('publicacioncientifica')
        ->join('actividad', 'publicacioncientifica.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->select(
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
                $publicaciones->termino = $publicaciones->termino.date("Y");
                //formateo de columna Profesor
                $publicaciones->nombres = $publicaciones->nombres.' '.$publicaciones->apellidoPaterno.' '.$publicaciones->apellidoMaterno;

                return $publicaciones;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($publicaciones): array
    {
        return [
            $publicaciones->rut,
            $publicaciones->nombres,
            $publicaciones->titulo,
            $publicaciones->journal,
            $publicaciones->termino,
            $publicaciones->indexacion
        ];
    }
}
