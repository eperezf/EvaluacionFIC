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

class InvestigacionPatenteExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Patentes Publicadas y/o Concedidas'],
            ['Lea atentamente las siguientes indicaciones:'],
            ['Para completar este documento debe tener en consideración los siguientes pasos:
            1. Las columnas de color amarillo no deben ser rellenadas.
            2. En la columna "Rut académico" debe escribir el rut del profesor con guión y sin puntos.
            3. En la columna "Nombre académico" y "Apellido académico" debe escribir dicha información con tilde y en mayúscula.
            4. En la columna "Título" debe escribir el nombre de la patente.
            5. En la columna "Nro Registro" debe escribir el número de registro de su patente.
            6. En la columna "Fecha Registro" debe escribir la fecha en la que inició su patente, el formato es Año-Mes-Día. (Ej: 2019-05-06)
            7. En la columna "Fecha Concedida" debe escribir la fecha en la que finalizó su patente, el formato es Año-Mes-Día. (Ej: 2019-05-06)
            8. Solo de ser necesario en columna "Nota" debe escribir un número entre 1.0 a 7.0, es decir, el número tiene que ser separado por punto. Esto para evaluar el desempeño
            del profesor en esa actividad.
            '],
            [
                'Id',
                'Id Académico',
                'Rut Académico',
                'Nombre Académico',
                'Apellido Académico',
                'Título',
                'Nro Registro',
                'Fecha Registro',
                'Fecha Concedida',
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
        $patentes = DB::table('patente')
        ->join('actividad', 'patente.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->select(
            'patente.id as id',
            'user.id as userid',
            'user.rut as rut',
            'user.nombres',
            'user.apellidoPaterno',
            'user.apellidoMaterno',
            'patente.titulo',
            'patente.numeroregistro',
            'patente.fecharegistro',
            'patente.fechaconcedida',
            'user_actividad.calificacion')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $patentes;
    }

    public function prepareRows($rows): array
    {
        return array_map(
            function ($patentes)
            {
                //formateo de columna Fecha
                $patentes->fecharegistro = explode('-', $patentes->fecharegistro)[2].'-'.explode('-', $patentes->fecharegistro)[1].'-'.explode('-', $patentes->fecharegistro)[0];
                $patentes->fechaconcedida = explode('-', $patentes->fechaconcedida)[2].'-'.explode('-', $patentes->fechaconcedida)[1].'-'.explode('-', $patentes->fechaconcedida)[0];
                return $patentes;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($patentes): array
    {
        return [
            $patentes->id,
            $patentes->userid,
            $patentes->rut,
            $patentes->nombres,
            $patentes->apellidoPaterno,
            $patentes->titulo,
            $patentes->numeroregistro,
            $patentes->fecharegistro,
            $patentes->fechaconcedida
        ];
    }
}
