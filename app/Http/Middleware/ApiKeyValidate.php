<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ApiKey;
use App\Traits\PeticionesTrait;

class ApiKeyValidate
{
    use PeticionesTrait;

    public function handle(Request $request, Closure $next)
    {

        //guardamos la peticion en la base de datos
        $this->GuardarPeticiones($request);

        //verificamos que viene un api_key en la peticion
        if (!$request->has("api_key")) {
            return response()->json([
              'status' => 401,
              'message' => 'Es necesario proporcionar una API Key.',
            ], 401);
          }

        //extraer el api_key de la peticion
        $apikey=ApiKey::where('api_key', $request->api_key)->first();

        //comprobar que el api_key existe
        if (!$apikey) {
            return response()->json([
              'status' => 401,
              'message' => 'Acceso no autorizado',
            ], 401);
        }

        //comprobamos si tiene creditos suficientes para generar la peticion
        if($apikey->user->creditos>0){


            $user=$apikey->user;

            $request=$request->merge(['id'=>$user->id]);

            return $next($request);


        }else{
            return response()->json([
              'status' => 401,
              'message' => 'No tienes creditos suficientes',
            ], 401);
        }  

        
    }
}
