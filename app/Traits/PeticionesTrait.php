<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Peticiones;

trait PeticionesTrait
{
    public function GuardarPeticiones(Request $request)
    {

        if ($request->all()==null) {
            $datos_enviados=json_encode('');
        }else{
            $datos_enviados=json_encode($request->all());
        }


        $peticion = new Peticiones;
        $peticion->ip_address = $request->ip();
        $peticion->metodo = $request->method();
        $peticion->endpoint_peticion = $request->fullUrl();
        $peticion->datos_enviados = $datos_enviados;
        $peticion->api_key = $request->api_key;
        $peticion->save();
        

        

    }
}