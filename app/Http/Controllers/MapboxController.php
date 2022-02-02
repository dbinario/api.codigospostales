<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapboxController extends Controller
{
    //
    public function Geocoding(Request $request){

        $request->validate([
            'codigo_postal' => 'required|numeric|digits:5'
        ],[
            'codigo_postal.required' => 'El campo código postal es obligatorio',
            'codigo_postal.numeric' => 'El campo código postal debe ser numérico',
            'codigo_postal.digits' => 'El campo código postal debe tener 5 dígitos'
        ]);

        $codigo_postal = $request->codigo_postal;

        

    }
    
}
