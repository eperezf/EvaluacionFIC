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


class OtrosAdmisionYDifusionExport implements  FromArray, WithHeadings, ShouldAutoSize, WithMapping, WithStyles, WithColumnWidths
{
   //Agregamos los encabezados de las columnas
   public function headings(): array
   {
       return[
           ['Actividades de admisión y difusión FIC'],
           ['Lea atentamente las siguientes indicaciones:'],
           ['Para completar este documento debe tener en consideración los siguientes pasos:
           1. Las columnas de color amarillo no deben ser rellenadas.
           2. En la columna "Rut académico" debe escribir el rut del profesor con guión y sin puntos.
           3. En la columna "Nombre académico" y "Apellido académico" debe escribir dicha información con tilde y en mayúscula.
           4. En la columna "Nombre Actividad" debe escribir el título de la actividad.
           6. En la columna "Tipo" debe escribir a que área pertenece.
           7. Solo de ser necesario en columna "Nota" debe escribir un número entre 1.0 a 7.0, es decir, el número tiene que ser 
           separado por punto. Esto para evaluar el desempeño del profesor en esa actividad.
           '],
           ['Id','Id académico','Rut académico', 'Nombre académico', 'Apellido académico', 'Nombre Actividad', 'Tipo', 'Nota']
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
       $sheet->getRowDimension('3')->setRowHeight(140);

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
       $admisiondifusion = DB::table('admisiondifusion')
       ->join('actividad','admisiondifusion.idactividad','=','actividad.id')
       ->join('user_actividad','actividad.id','=','user_actividad.idactividad')
       ->join('user','user_actividad.iduser','=','user.id')
       ->select(
           'admisiondifusion.id',
           'user.id as userid',
           'user.rut as rut',
           'user.nombres',
           'user.apellidoPaterno as apellido',
           'admisiondifusion.tipo',
           'admisiondifusion.nombre as nombreactividad')
       ->whereNull('user_actividad.calificacion')
       ->get()
       ->toArray();
       return $admisiondifusion;
   }

   //ponemos los datos obtenidos en columnas
   public function map($admisiondifusion): array
   {
       return [
           $admisiondifusion->id,
           $admisiondifusion->userid,
           $admisiondifusion->rut,
           $admisiondifusion->nombres,
           $admisiondifusion->apellido,
           $admisiondifusion->nombreactividad,
           $admisiondifusion->tipo,
       ];
   }
}
