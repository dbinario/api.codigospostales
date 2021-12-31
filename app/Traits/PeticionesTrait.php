<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Peticiones;

trait PeticionesTrait
{
    public function GuardarPeticiones(Request $request)
    {
        
        $peticion = new Peticiones;
        $peticion->ip_address = $request->ip();
        $peticion->metodo = $request->method();
        $peticion->peticion = $request->fullUrl();
        $peticion->metodo_peticion = $request->method();
        $peticion->token = $request->header('Authorization');
        $peticion->error = $request->header('error');
        $peticion->save();


    }
}