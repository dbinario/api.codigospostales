<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\EstadosResource;

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

        return EstadosResource::collection($estados);

    }
}
