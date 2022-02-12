<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Http\Resources\ArrayResource;
use App\Http\Resources\ErrorResource;

use App\Traits\CreditosTrait;


class EstadosController extends Controller
{

    use CreditosTrait;
    //
    public function ObtenerEstados(Request $request)
    {
        //obtenemos los estados
        $estados = DB::table('codigos_postales')
            ->select('d_estado')
            ->distinct()
            ->orderBy('d_estado', 'asc')
            ->get();

            
        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);
        
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

         //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);
        
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

        if(count($municipios) == 0)
        {

            return new ErrorResource(
                [
                    "code" => 404,
                    "message" => "No se encontró el municipio",
                    "estado" => $request->estado
                ]
            );
        
        }
        else{
            return new ArrayResource($municipios);
        }  


    }

    //colonias por municipio

    public function ObtenerColoniasMunicipio(Request $request)
    {

        $request->validate([
            'municipio' => 'required|string',
            'estado' => 'required|string',
        ], [
            'municipio.required' => 'El municipio es requerido',
            'municipio.string' => 'El municipio debe ser un string',
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser un string',
        ]);

        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        //obtenemos las colonias

        $colonias = DB::table('codigos_postales')
            ->select('d_asenta')
            ->where('d_mnpio', $request->municipio)
            ->where('d_estado', $request->estado)
            ->distinct()
            ->orderBy('d_asenta', 'asc')
            ->get();

        //colapsamos las colonias
        $array = Arr::pluck($colonias, 'd_asenta');
        $colonias=['colonias' => $array];

        if(count($colonias) == 0)
        {

            return new ErrorResource(
                [
                    "code" => 404,
                    "message" => "No se encontró el municipio",
                ]
            );
        
        }
        else{
            return new ArrayResource($colonias);
        }  


    

    }



}
