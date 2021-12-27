<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Http\Resources\ArrayResource;


class EstadosController extends Controller
{
    //
    public function ObtenerEstados()
    {
        //obtenemos los estados
        $estados = DB::table('codigos_postales')
            ->select('d_estado')
            ->distinct()
            ->orderBy('d_estado', 'asc')
            ->get();

        
        //colapsamos los estados

        $array = Arr::pluck($estados, 'd_estado');
        $estados=['estados' => $array];

        return new ArrayResource($estados);

    }

    //municipios por estado
    public function ObtenerMunicipios(Request $request)
    {
        //validamos que viene el estado
        $request->validate([
            'estado' => 'required|string',
        ], [
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser una cadena de texto',
        ]);
        
        //obtenemos los municipios
        $municipios = DB::table('codigos_postales')
            ->select('d_mnpio')
            ->where('d_estado', $request->estado)
            ->distinct()
            ->orderBy('d_mnpio', 'asc')
            ->get();

        //colapsamos los municipios
        $array = Arr::pluck($municipios, 'd_mnpio');
        $municipios=['municipios' => $array];

        return new ArrayResource($municipios);
    }


}
