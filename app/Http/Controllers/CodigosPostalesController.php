<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


use App\Traits\CreditosTrait;


//recursos
use App\Http\Resources\CodigosPostalesResource;
use App\Http\Resources\ArrayResource;

class CodigosPostalesController extends Controller
{

    use CreditosTrait;
    //funcion para buscar por codigo postal
    public function BuscarCodigoPostal(Request $request)
    {
        
        $request->validate([
            'codigo_postal' => 'required|numeric|digits:5',
        ], [
            'codigo_postal.required' => 'El codigo postal es requerido',
            'codigo_postal.numeric' => 'El codigo postal debe ser numerico',
            'codigo_postal.digits' => 'El codigo postal debe tener 5 digitos',
        ]);

        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        //buscamos por codigo postal
        $codigo_postal = DB::table('codigos_postales')
            ->select('d_codigo', 'd_asenta',  'd_tipo_asenta', 'd_mnpio', 'd_estado', 'd_ciudad')
            ->where('d_codigo', $request->codigo_postal)
            ->get();


        //regresamos la respuesta
        if(count($codigo_postal) == 0)
        {

            return new ArrayResource(
                [
                    "code" => 404,
                    "message" => "No se encontró el código postal",
                ]
            );
        
        }
        else{
            return CodigosPostalesResource::collection($codigo_postal);
        }

        
    
    }

    public function CoincidenciaCodigoPostal(Request $request)
    {

        $request->validate([
            'codigo_postal' => 'required|numeric|digits:4',
        ], [
            'codigo_postal.required' => 'El codigo postal es requerido',
            'codigo_postal.numeric' => 'El codigo postal debe ser numerico',
            'codigo_postal.digits' => 'El codigo postal debe tener 4 digitos',
        ]);

        
        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        //buscamos por coincidencia de codigo postal

        $codigo_postal = DB::table('codigos_postales')
            ->select('d_codigo')
            ->distinct()
            ->where('d_codigo', 'like', '%'.$request->codigo_postal.'%')
            ->get();
   
        
            //colapsamos el array
            $array = Arr::pluck($codigo_postal, 'd_codigo');
            //le creamos el array para poder retornar la informacion
            $codigos_postales=['codigos_postales' => $array];


             //regresamos la respuesta
        if(count($codigo_postal) == 0)
        {

            return new ArrayResource(
                [
                    "code" => 404,
                    "message" => "No se encontró el código postal",
                ]
            );
        
        }
        else{
            return new ArrayResource($codigos_postales);
        }
        

    }

    public function CodigosPostalesMunicipio(Request $request)
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

        //buscamos por coincidencia de codigo postal

        $codigo_postal = DB::table('codigos_postales')
            ->select('d_codigo')
            ->distinct()
            ->where('d_mnpio', $request->municipio)
            ->where('d_estado', $request->estado)
            ->get();
   
        
            //colapsamos el array
            $array = Arr::pluck($codigo_postal, 'd_codigo');
            //le creamos el array para poder retornar la informacion
            $codigos_postales=['codigos_postales' => $array];


            if(count($codigo_postal) == 0)
            {
    
                return new ArrayResource(
                    [
                        "code" => 404,
                        "message" => "No se encontró el código postal",
                    ]
                );
            
            }
            else{
                return new ArrayResource($codigos_postales);
            }   

    }

    public function ObtenerColoniasCP(Request $request)
    {
        
        $request->validate([
            'codigo_postal' => 'required|numeric|digits:5'
        ], [
            'codigo_postal.required' => 'El codigo postal es requerido',
            'codigo_postal.numeric' => 'El codigo postal debe ser numerico',
            'codigo_postal.digits' => 'El codigo postal debe tener 5 digitos',
        ]);

        
        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        $colonias = DB::table('codigos_postales')
        ->select('d_asenta')
        ->distinct()
        ->where('d_codigo', $request->codigo_postal)
        ->get();

        
           //colapsamos el array
           $array = Arr::pluck($colonias, 'd_asenta');
           //le creamos el array para poder retornar la informacion
           $colonias=['colonias' => $array];


           if(count($colonias) == 0)
           {
   
               return new ArrayResource(
                   [
                       "code" => 404,
                       "message" => "No se encontró el código postal",
                   ]
               );
           
           }
           else{
               return new ArrayResource($colonias);
           }  

    }

    public function ObtenerCodigosPostalesEstado(Request $request)
    {

        $request->validate([
            'estado' => 'required|string',
        ], [
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser un string',
        ]);

        
        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        $codigos_postales = DB::table('codigos_postales')
        ->select('d_codigo')
        ->distinct()
        ->where('d_estado', $request->estado)
        ->get();

        
           //colapsamos el array
           $array = Arr::pluck($codigos_postales, 'd_codigo');
           //le creamos el array para poder retornar la informacion
           $codigos_postales=['codigos_postales' => $array];


           
           if(count($codigos_postales) == 0)
           {
   
               return new ArrayResource(
                   [
                       "code" => 404,
                       "message" => "No se encontró el código postal",
                   ]
               );
           
           }
           else{
               return new ArrayResource($codigos_postales);
           }  

    }


    public function BusquedaAvanzada(Request $request){

        $codigos_postales = DB::table('codigos_postales')
        ->select('d_codigo')
        ->distinct()
        ->get();


    }



}