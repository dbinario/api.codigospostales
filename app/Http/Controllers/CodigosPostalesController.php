<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

//recursos
use App\Http\Resources\CodigosPostalesResource;
use App\Http\Resources\ArrayResource;

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

    public function CoincidenciaCodigoPostal(Request $request){

        $request->validate([
            'codigo_postal' => 'required|numeric|digits:4',
        ]); 

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




}
