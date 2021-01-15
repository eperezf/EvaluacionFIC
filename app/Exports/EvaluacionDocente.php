<?php

namespace App\Exports;

use App\User;
use App\Curso;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class EvaluacionDocente implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    public function headings(): array
    {
        return [
            'Nombres',
            'Apellido Paterno',
            'Apellido Materno',
            'Curso',
            'Nota'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }

    public function map($user): array
    {
        return [
            $user->nombres,
            $user->apellidoPaterno,
            $user->apellidoPaterno,
        ];
    }

    public function query()
    {
        return User::query();
    }
}
