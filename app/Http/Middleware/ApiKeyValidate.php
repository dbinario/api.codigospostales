<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ApiKey;
use App\Traits\PeticionesTrait;

use App\Http\Resources\ErrorResource;

class ApiKeyValidate
{
    use PeticionesTrait;

    public function handle(Request $request, Closure $next)
    {

        //guardamos la peticion en la base de datos
        $this->GuardarPeticiones($request);

        //verificamos que viene un api_key en la peticion
        if (!$request->has("api_key")) {

            return new ErrorResource(
              [
                "code" => 401,
                "message" => "No se encontró la api_key",
              ]
            );
      


          }

        //extraer el api_key de la peticion
        $apikey=ApiKey::where('api_key', $request->api_key)->first();

        //comprobar que el api_key existe
        if (!$apikey) {
            return new ErrorResource(
              [
                "code" => 402,
                "message" => "Acceso no autorizado",
              ]
            );
        }

        //comprobamos si tiene creditos suficientes para generar la peticion
        if($apikey->user->creditos>0){


          //actualizamos la utilizacion del api key
            $apikey->last_used_at = now();
            $apikey->save();

            $user=$apikey->user;

            $request=$request->merge(['id'=>$user->id]);

            return $next($request);


        }else{
          return new ErrorResource(
            [
              'code' => 403,
              'message' => 'No tienes creditos suficientes',
            ]);
        }  

        
    }
}
