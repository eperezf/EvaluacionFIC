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
                'Rut Profesor',
                'Nombre Profesor',
                'Programa',
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
            1 => ['font' => ['bold' => true],
                  'font' => ['size' => 20]],

            4 => ['font' => ['bold' => true]]
        ];
    }
    
    public function array(): array
    {
        $administracionacademica = DB::table('administracionacademica')
        ->join('actividad', 'administracionacademica.idactividad', '=', 'actividad.id')
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
            'user_actividad.calificacion')
        ->whereNull('user_actividad.calificacion')
        ->get()
        ->toArray();
        return $administracionacademica;
    }

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($administracionacademica)
            {
                //formateo de columna Profesor
                $administracionacademica->nombres = $administracionacademica->nombres.' '.$administracionacademica->apellidoPaterno.' '.$administracionacademica->apellidoMaterno;

                return $administracionacademica;
            }, $rows
        );
    }

    //ponemos los datos obtenidos en columnas
    public function map($administracionacademica): array
    {
        return [
            $administracionacademica->id,
            $administracionacademica->userid,
            $administracionacademica->rut,
            $administracionacademica->nombres,
            $administracionacademica->programa,
            $administracionacademica->actividad,
            $administracionacademica->meses,
            $administracionacademica->carga
        ];
    }
}
