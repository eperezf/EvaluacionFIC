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
            ['Lea atentamente las siguientes indicaciones:'],
            ['Para completar este documento debe tener en consideración los siguientes pasos:
            1. Las columnas de color amarillo no deben ser rellenadas.
            2. En la columna "Rut académico" debe escribir el rut del profesor con guión y sin puntos.
            3. En la columna "Nombre académico" y "Apellido académico" debe escribir dicha información con tilde y en mayúscula.
            4. En la columna "Programa" debe escribir el nombre con el número (en caso de ser necesario) del programa.
            5. En la columna "Actividad" debe escribir que está realizando. (Ej: Dirección Académica)
            6. En la columna "Meses" debe escribir el tiempo que duró la actividad, el formato es en meses dividimos por un guión. (Ej: Mar-Dic)
            7. En la columna "Carga" debe escribir el número correspondiente a la carga, en caso de ser decimal debe estar dividido en ",". 
            8. Solo de ser necesario en columna "Nota" debe escribir un número entre 1.0 a 7.0, es decir, el número tiene que ser separado por punto.
            Esto para evaluar el desempeño del profesor en esa actividad.
            '],
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
        $sheet->mergeCells('A3:J3');
        $sheet->getRowDimension('3')->setRowHeight(165);

        return [
            1 =>
            [
                'font' =>
                [
                    'bold' => true,
                    'size' => 20
                ]
            ],

            2 => ['font' => ['bold' => true, 'underline' => true]],

            3 => ['alignment' => ['wrapText' => true]],

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
