<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//recursos
use App\Http\Resources\CodigosPostalesResource;
use App\Http\Resources\EstadosResource;

class CodigosPostalesController extends Controller
{
    //funcion para buscar por codigo postal
    public function BuscarCodigoPostal(Request $request)
    {

        $request->validate([
            'codigo_postal' => 'required|numeric|digits:5',
        ]); 

        //buscamos por codigo postal
        $codigo_postal = DB::table('codigos_postales')
            ->where('d_codigo', $request->codigo_postal)
            ->get();
        
        //retornamos la respuesta
        return CodigosPostalesResource::collection($codigo_postal);

    }

    public function ObtenerEstados()
    {
        //obtenemos los estados
        $estados = DB::table('codigos_postales')
            ->select('d_estado')
            ->distinct()
            ->orderBy('d_estado', 'asc')
            ->get();

        return EstadosResource::collection($estados);

    }
    


}
