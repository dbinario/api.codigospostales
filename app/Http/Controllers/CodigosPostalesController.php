<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodigosPostalesController extends Controller
{
    //

    public function BuscarCodigoPostal(Request $request)
    {

        $request->validate([
            'codigo_postal' => 'required|numeric|digits:5',
        ]); 
        
        return  $request->codigo_postal;

    }


}
