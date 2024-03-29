<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\ArrayResource;
use App\Http\Resources\ErrorResource;

use App\Traits\CreditosTrait;


class EstadosController extends Controller
{

    use CreditosTrait;
    //
    public function ObtenerEstados(Request $request)
    {
        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);
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

        
         //descontamos creditos
         CreditosTrait::DescontarCreditos($request->id, 1);

         
        $rules = [
            'estado' => 'required|string',
        ];

        $messages=[
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser un string',
        ];

        $data=$request->all();
        
        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) {

            return new ErrorResource(
                 [
                     'code'=>422, 
                     'validacion'=>$validator->errors() 
                 ]);

        }

        
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

        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);


        $rules = [
            'municipio' => 'required|string',
            'estado' => 'required|string',
        ];

        $messages=[
            'municipio.required' => 'El municipio es requerido',
            'municipio.string' => 'El municipio debe ser un string',
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser un string',
        ];

        $data=$request->all();

        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) {

            return new ErrorResource(
                 [
                     'code'=>422, 
                     'validacion'=>$validator->errors() 
                 ]);

        }


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
