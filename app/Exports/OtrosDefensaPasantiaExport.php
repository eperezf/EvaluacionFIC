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


class OtrosDefensaPasantiaExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return[
            ['Defensa de Pasantía'],
            ['Lea atentamente las siguientes indicaciones:'],
            ['Para completar este documento debe tener en consideración los siguientes pasos:
            1. Las columnas de color amarillo no deben ser rellenadas.
            2. En la columna "Rut académico" debe escribir el rut del profesor con guión y sin puntos.
            3. En la columna "Nombre académico" y "Apellido académico" debe escribir dicha información 
            con tilde y en mayúscula.
            4. En la columna "Tipo" debe escribir el nombre y la fecha de la defensa de pasantías. (Ej: PED Enero 2021)
            6. En la columna "#Defensas" debe escribir la cantidad de defensas realizadas.
            7. Solo de ser necesario en columna "Nota" debe escribir un número entre 1.0 a 7.0, es decir, el número tiene 
            que ser separado por punto. Esto para evaluar el desempeño del profesor en esa actividad.
            '],
            ['Id','Id académico','Rut académico', 'Nombre académico', 'Apellido académico', 'Tipo', '# Defensas','Nota']
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
        $sheet->mergeCells('A3:L3');
        $sheet->getRowDimension('3')->setRowHeight(150);

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
        $defensas = DB::table('defensapasantia')
        ->join('actividad', 'defensapasantia.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->select(
            'defensapasantia.id',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno as apellido',
            'defensapasantia.tipo',
            'defensapasantia.numerodefensas')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $defensas;
    }

    //ponemos los datos obtenidos en columnas
    public function map($defensas): array
    {
        return [
            $defensas->id,
            $defensas->userid,
            $defensas->rut,
            $defensas->nombres,
            $defensas->apellido,
            $defensas->tipo,
            $defensas->numerodefensas,
        ];
    }
}
