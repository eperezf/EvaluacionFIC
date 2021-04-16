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

class InvestigacionPatenteExport implements FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
    //Agregamos los encabezados de las columnas
    public function headings(): array
    {
        return [
            ['Patentes Publicadas y/o Concedidas'],
            ['A continuación debe calificar, con una nota el 1.0 al 7.0, a cada una de las patentes que aparecen a continuación.'],
            [],
            [
                'Id',
                'Id Académico',
                'Rut Profesor',
                'Nombre',
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
        return [
            1 => ['font' => ['bold' => true],
                  'font' => ['size' => 20]],

            4 => ['font' => ['bold' => true]]
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

    //formateamos las columnas
    public function prepareRows($rows): array
    {
        return array_map(
            function ($patentes)
            {
                //formateo de columna Profesor
                $patentes->nombres = $patentes->nombres.' '.$patentes->apellidoPaterno.' '.$patentes->apellidoMaterno;

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
            $patentes->titulo,
            $patentes->numeroregistro,
            $patentes->fecharegistro,
            $patentes->fechaconcedida
        ];
    }
}
