<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Actividad;
use App\User_actividad;
use App\Guiatesis;

class GuiaTesisImport implements ToCollection, WithHeadingRow
{
    public function headingRow(): int { return 4; }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $actividad = Actividad::find(Guiatesis::find($row['id_investigacion'])->idactividad);
            $user_actividad = User::where('idactividad', $actividad->id)
                ->where('iduser', $row['id_profesor'])
                ->get()[0];
            
            $user_actividad->calificacion = $row['nota'];
            $user_actividad->save();
        }
    }
}
