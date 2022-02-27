<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Peticiones;
use Illuminate\Support\Arr;

trait PeticionesTrait
{
    public function GuardarPeticiones(Request $request)
    {

        //convertimos la peticion a json

        if ($request->all()==null) {
            $datos_enviados=json_encode('');
        }else{
            $datos_enviados=json_encode($request->all());
        }

        //quitamos los campos que no queremos guardar
        $datos_enviados=json_encode(Arr::except($request->all(), ['api_key']));


        //guardamos la peticion en la base de datos
        $peticion = new Peticiones;
        $peticion->ip_address = $request->ip();
        $peticion->metodo = $request->method();
        $peticion->endpoint_peticion = $request->fullUrl();
        $peticion->datos_enviados = $datos_enviados;
        $peticion->api_key = $request->api_key;
        $peticion->save();
        

        

    }
}