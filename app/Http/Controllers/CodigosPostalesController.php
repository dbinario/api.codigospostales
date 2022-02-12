<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

use App\Traits\CreditosTrait;


//recursos
use App\Http\Resources\CodigosPostalesResource;
use App\Http\Resources\ArrayResource;
use App\Http\Resources\ErrorResource;


class CodigosPostalesController extends Controller
{

    use CreditosTrait;
    //funcion para buscar por codigo postal
    public function BuscarCodigoPostal(Request $request)
    {

         //descontamos creditos
         CreditosTrait::DescontarCreditos($request->id, 1);

        $rules = [
            'codigo_postal' => 'required|numeric|digits:5',
        ];

        $messages=[
            'codigo_postal.required' => 'El codigo postal es requerido',
            'codigo_postal.numeric' => 'El codigo postal debe ser numerico',
            'codigo_postal.digits' => 'El codigo postal debe tener 5 digitos',
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

       

        //buscamos por codigo postal
        $codigo_postal = DB::table('codigos_postales')
            ->select('d_codigo', 'd_asenta',  'd_tipo_asenta', 'd_mnpio', 'd_estado', 'd_ciudad')
            ->where('d_codigo', $request->codigo_postal)
            ->get();


        //regresamos la respuesta
        if(count($codigo_postal) == 0)
        {

            return new ErrorResource( 
                [
                 'code'=>404, 
                 'message' => 'No se encontró el código postal',
                 'codigo_postal'=>$request->codigo_postal
                ]
            );
        
        }
        else{
            return CodigosPostalesResource::collection($codigo_postal);
        }

        
    
    }

    public function CoincidenciaCodigoPostal(Request $request)
    {
        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        $rules = [
            'codigo_postal' => 'required|numeric|digits:4',
        ];

        $messages=[
            'codigo_postal.required' => 'El codigo postal es requerido',
            'codigo_postal.numeric' => 'El codigo postal debe ser numerico',
            'codigo_postal.digits' => 'El codigo postal debe tener 4 digitos',
        ];

        
        $data=$request->all();

        $validator = Validator::make($data, $rules,$messages);
        
        if ($validator->fails()) 
        {

            return new ErrorResource( ['code'=>422, 'validacion'=>$validator->errors() ]);    

        }


        

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

            return new ErrorResource( 
                [
                'code'=>404, 
                "message" => "No se encontró el código postal" ,
                'codigo_postal'=>$request->codigo_postal
                ]);
        

        }
        else{
            return new ArrayResource($codigos_postales);
        }
        

    }

    public function CodigosPostalesMunicipio(Request $request)
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
        
        if ($validator->fails()) 
        {

            return new ErrorResource( ['code'=>422, 'validacion'=>$validator->errors() ]);    

        }

        
     

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

                return new ErrorResource( 
                    [
                        'code'=>404, 
                        "message" => "No se encontraron códigos postales",
                        'municipio'=>".$request->municipio.",
                        'estado'=>$request->estado
                    ]);
        
            
            }
            else{
                return new ArrayResource($codigos_postales);
            }   

    }

    public function ObtenerColoniasCP(Request $request)
    {

        //descontamos creditos
        CreditosTrait::DescontarCreditos($request->id, 1);

        $rules = [
            'codigo_postal' => 'required|numeric|digits:5',
        ];

        $messages=[
            'codigo_postal.required' => 'El codigo postal es requerido',
            'codigo_postal.numeric' => 'El codigo postal debe ser numerico',
            'codigo_postal.digits' => 'El codigo postal debe tener 5 digitos',
        ];

        $data=$request->all();

        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) 
        {

            return new ErrorResource( ['code'=>422, 'validacion'=>$validator->errors() ]);    

        }

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
   
            return new ErrorResource( 
                [
                    'code'=>404, 
                    "message" => "No se encontró informacion del código postal",
                    'codigo_postal'=>$request->codigo_postal
                ]);
        
           
           }
           else{
               return new ArrayResource($colonias);
           }  

    }

    public function ObtenerCodigosPostalesEstado(Request $request)
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

        if ($validator->fails()) 
        {

            return new ErrorResource( ['code'=>422, 'validacion'=>$validator->errors() ]);    

        }


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
   
            return new ErrorResource( ['code'=>404, "message" => "No se encontró el código postal" ]);     
           
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