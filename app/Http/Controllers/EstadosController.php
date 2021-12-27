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
}
