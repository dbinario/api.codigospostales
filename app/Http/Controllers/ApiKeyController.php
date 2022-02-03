<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ApiKey;

use Illuminate\Support\Facades\DB;

use App\Http\Resources\ArrayResource;


class ApiKeyController extends Controller
{
    public function GenerarApiKey(Request $request){

        //se valida que el nombre api venga en el request
        $request->validate([
            'nombre_api' => 'required|string|max:255'
        ],[
            'nombre_api.required' => 'El nombre de la api es requerido',
            'nombre_api.string' => 'El nombre de la api debe ser una cadena de texto',
            'nombre_api.max' => 'El nombre de la api debe tener como maximo 255 caracteres'
        ]);


        //se genera una api key unica en la tabla api_keys
        $apikey=bin2hex(random_bytes(16));

        //verificamos que no exista una apikey con esa cadena si no generamos uno nuevo
        while(DB::table('api_keys')->where('api_key',$apikey)->exists()){
            $apikey=bin2hex(random_bytes(16));
        }


        //guardamos el api key y lo vinculamos al usuario que lo creo
        $api_key=ApiKey::create([
            'api_key'=>$apikey,
            'nombre_api'=>$request->nombre_api,
            'user_id'=>$request->user()->id,
        ]);
        
        //retornamos el api key creado
        return  new ArrayResource([
            'api_key'=>$api_key->api_key,
        ]);
    }

}
