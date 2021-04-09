<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

use App\User;
use App\Curso;
use App\User_actividad;
use App\Actividad;

class EvaluacionDesempenoImport implements ToCollection, WithHeadingRow, WithCustomCsvSettings
{
    public function headingRow(): int { return 5; }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $actividad = Actividad::find(Curso::find($row['id_curso'])->idactividad);
            $user_actividad = User_actividad::where('idactividad', $actividad->id)
                ->where('iduser', $row['id_profesor'])
                ->get()[0];

            $user_actividad->calificacion = $row['nota'];
            $user_actividad->save();
        }
    }
}
