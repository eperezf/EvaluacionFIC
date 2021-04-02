<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDesempenoExport;
use App\Imports\EvaluacionDesempenoImport;
use App\Http\Requests\StoreEvalDocente;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class BuzonAdmin extends Controller
{
    public function exportEvalDesempeno($idSubarea)
    {
        return Excel::download(new EvaluacionDesempenoExport($idSubarea), 'Evaluación Desempeño.xlsx');
    }

    public function importEvalDesempeno(Request $request)
    {
        // Se valida el formulario y al retornar exito, se ejecuta Excel::import()
        $validator = new StoreEvalDocente;
        $this->validate($request, $validator->rules(), $validator->messages());
        Excel::import(new EvaluacionDesempenoImport, $request->file('evalDesempenoFile'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }

    public function importEncuestaDocente()
    {
        Excel::import(new EncuestaDocenteImport);
        return;
    }
}
